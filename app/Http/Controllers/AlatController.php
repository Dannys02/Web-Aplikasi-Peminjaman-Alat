<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Peminjaman;

class AlatController extends Controller
{
  public function index()
  {
    // Mengambil semua data alat beserta kategorinya (Eager Loading)
    $semuaAlat = Alat::with("kategori")->get();

    $historySaya = \App\Models\Peminjaman::where("user_id", auth()->id())
      ->with("alats")
      ->latest()
      ->get();

    // Mengirim data ke view dashboard
    return view("dashboard", compact("semuaAlat", "historySaya"));
  }

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

  public function destroy($id)
  {
    $alat = Alat::findOrFail($id);

    // Cek apakah ada peminjaman aktif untuk alat ini
    $adaPeminjam = $alat
      ->peminjamans()
      ->whereIn("status", ["menunggu", "dipinjam"])
      ->exists();

    if ($adaPeminjam) {
      return redirect()
        ->back()
        ->with("error", "Alat tidak bisa dihapus karena sedang dipinjam!");
    }

    $alat->delete();
    return redirect()
      ->back()
      ->with("success", "Alat berhasil dihapus dari sistem.");
  }
}
