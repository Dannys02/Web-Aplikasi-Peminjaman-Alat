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
    // Cari data alat di awal agar tidak query berkali-kali
    $alat = Alat::findOrFail($id);

    // Validasi Stok (Cukup satu kali di awal)
    if ($alat->jumlah < 1) {
      return redirect()
        ->back()
        ->with("error", "Maaf, stok alat ini sedang kosong!");
    }

    // Validasi Pinjaman Aktif (Cukup satu kali)
    // Mengecek apakah user masih punya status 'menunggu' atau 'dipinjam' untuk alat ini
    $pinjamanAktif = Peminjaman::where("user_id", auth()->id())
      ->whereIn("status", ["menunggu", "dipinjam"])
      ->whereHas("alats", function ($query) use ($id) {
        $query->where("alats.id", $id);
      })
      ->exists();

    if ($pinjamanAktif) {
      return redirect()
        ->back()
        ->with("error", "Kamu masih memiliki pinjaman aktif untuk alat ini!");
    }

    // 4. Proses Simpan jika lolos semua validasi
    $pinjam = Peminjaman::create([
      "user_id" => auth()->id(),
      "tanggal_pinjam" => now(),
      "status" => "menunggu",
    ]);

    // Attach ke tabel pivot detail_peminjamans
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

    \App\Models\LogAktivitas::create([
      "nama_user" => auth()->user()->name,
      "peran" => auth()->user()->role->nama_role,
      "aksi" =>
        "Menyetujui peminjaman alat ID " .
        $id .
        " untuk user " .
        $pinjam->user->name,
    ]);

    return redirect()
      ->back()
      ->with("success", "Peminjaman telah disetujui!");
  }

  // 1. Fungsi yang dipicu tombol "Selesai & Kembalikan" oleh Siswa/Admin di awal
  public function kembalikan($id)
  {
    $pinjam = Peminjaman::findOrFail($id);

    if ($pinjam->status !== "dipinjam") {
      return redirect()
        ->back()
        ->with("error", "Status tidak valid.");
    }

    // Status berubah jadi menunggu_kembali (Barang sudah di meja admin, tapi belum dicek)
    $pinjam->update([
      "status" => "menunggu_kembali",
    ]);

    return redirect()
      ->back()
      ->with(
        "success",
        "Permintaan pengembalian dikirim. Serahkan barang ke petugas!"
      );
  }

  // Fungsi BARU: Admin mengonfirmasi barang sudah oke atau menolak
  public function konfirmasiKembalikan(Request $request, $id)
  {
    $pinjam = Peminjaman::findOrFail($id);
    $aksi = $request->aksi; // Kita kirim input 'konfirmasi' atau 'batal'

    if ($aksi == "konfirmasi") {
      $pinjam->update([
        "status" => "dikembalikan",
        "tanggal_kembali" => now(),
      ]);

      // Stok bertambah kembali
      foreach ($pinjam->alats as $alat) {
        $alat->increment("jumlah", $alat->pivot->jumlah);
      }

      return redirect()
        ->back()
        ->with("success", "Pengembalian selesai, stok telah diperbarui!");
    } else {
      // Jika batal (misal barang rusak/kurang), balikkan status ke 'dipinjam'
      $pinjam->update(["status" => "dipinjam"]);
      return redirect()
        ->back()
        ->with("error", "Pengembalian dibatalkan.");
    }
  }
}
