<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Peminjaman;

class AlatController extends Controller
{
  public function create()
  {
    $kategoris = \App\Models\Kategori::all();
    $semuaAlat = Alat::with("kategori")->get();

    return view("admin.tambah-alat", compact("kategoris", "semuaAlat"));
  }

  public function store(Request $request)
  {
    $request->validate([
      "nama_alat" => "required",
      "kategori_id" => "required",
      "jumlah" => "required|integer|min:1",
    ]);

    \App\Models\Alat::create($request->all());

    return back()->with("success", "Alat baru berhasil ditambahkan!");
  }

  public function update(Request $request, $id)
  {
    $request->validate([
      "nama_alat" => "required",
      "kategori_id" => "required",
      "jumlah" => "required|integer|min:0",
    ]);

    $alat = Alat::findOrFail($id);
    $alat->update($request->all());

    // Opsional: Catat ke Log Aktivitas
    \App\Models\LogAktivitas::create([
      "nama_user" => auth()->user()->name,
      "peran" => auth()->user()->role->nama_role,
      "aksi" => "MENGUBAH data alat: " . $alat->nama_alat,
    ]);

    return back()->with("success", "Data alat berhasil diperbarui!");
  }

  public function destroy($id)
  {
    $alat = Alat::findOrFail($id);

    // Cek apakah alat pernah terlibat dalam transaksi APAPUN (sedang dipinjam atau sudah selesai)
    // Ini mengecek seluruh isi tabel pivot detail_peminjamans
    if ($alat->peminjamans()->exists()) {
      return redirect()
        ->back()
        ->with(
          "error",
          "Alat tidak bisa dihapus karena memiliki riwayat peminjaman. Silakan ubah stok menjadi 0 saja jika alat sudah rusak."
        );
    }

    $alat->delete();
    return redirect()
      ->back()
      ->with("success", "Alat berhasil dihapus.");
  }
}
