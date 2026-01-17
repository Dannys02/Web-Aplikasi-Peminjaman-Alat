<?php
namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Alat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeminjamanController extends Controller
{
  public function store(Request $request, $id)
  {
    // Cek apakah siswa ini sudah punya pinjaman aktif untuk barang tersebut
    $adaPinjamanAktif = Peminjaman::where("user_id", auth()->id())
      ->whereIn("status", ["menunggu", "dipinjam"])
      ->whereHas("alats", function ($query) use ($id) {
        $query->where("alats.id", $id);
      })
      ->exists();

    if ($adaPinjamanAktif) {
      return redirect()
        ->back()
        ->with("error", "Kamu masih memiliki pinjaman aktif untuk alat ini!");
    }

    // Cek Stok (Keamanan tambahan)
    $alat = Alat::findOrFail($id);
    if ($alat->jumlah < 1) {
      return redirect()
        ->back()
        ->with("error", "Maaf, stok barang baru saja habis.");
    }

    // Proses Simpan (Kode yang sudah kamu buat sebelumnya)
    $pinjam = Peminjaman::create([
      "user_id" => auth()->id(),
      "tanggal_pinjam" => now(),
      "status" => "menunggu",
    ]);

    $pinjam->alats()->attach($id, ["jumlah" => 1]);

    return redirect()
      ->back()
      ->with("success", "Permintaan pinjam berhasil dikirim!");
  }

  public function konfirmasi($id)
  {
    $pinjam = Peminjaman::findOrFail($id);

    // Ubah status jadi dipinjam
    $pinjam->update(["status" => "dipinjam"]);

    // LOGIKA PENTING: Kurangi stok alat
    foreach ($pinjam->alats as $alat) {
      $jumlahPinjam = $alat->pivot->jumlah; // Ambil angka dari tabel detail
      $alat->decrement("jumlah", $jumlahPinjam); // Kurangi stok di tabel alats
    }

    return redirect()
      ->back()
      ->with("success", "Peminjaman telah disetujui!");
  }

  public function kembalikan($id)
  {
    $pinjam = Peminjaman::findOrFail($id);

    // Pastikan hanya yang statusnya 'dipinjam' yang bisa dikembalikan
    if ($pinjam->status !== "dipinjam") {
      return redirect()
        ->back()
        ->with("error", "Status tidak valid.");
    }

    // 1. Ubah status & isi tanggal_kembali
    $pinjam->update([
      "status" => "dikembalikan",
      "tanggal_kembali" => now(),
    ]);

    // 2. LOGIKA PENTING: Tambahkan kembali stok alat
    foreach ($pinjam->alats as $alat) {
      $jumlahPinjam = $alat->pivot->jumlah;
      $alat->increment("jumlah", $jumlahPinjam); // Stok bertambah lagi
    }

    return redirect()
      ->back()
      ->with("success", "Barang telah dikembalikan!");
  }
}
