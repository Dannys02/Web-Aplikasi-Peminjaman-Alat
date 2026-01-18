<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
  public function index()
  {
    $kategoris = Kategori::all();
    return view("admin.tambah-kategori", compact("kategoris"));
  }

  public function store(Request $request)
  {
    $request->validate([
      "nama_kategori" => "required|unique:kategoris,nama_kategori",
    ]);

    Kategori::create($request->all());

    return redirect()
      ->back()
      ->with("success", "Kategori berhasil ditambahkan!");
  }

  public function destroy($id)
  {
    $kategori = Kategori::findOrFail($id);

    // Cek relasi agar tidak error jika kategori masih punya alat
    if ($kategori->alats()->count() > 0) {
      return redirect()
        ->back()
        ->with(
          "error",
          "Gagal! Kategori ini masih digunakan oleh beberapa alat."
        );
    }

    $kategori->delete();
    return redirect()
      ->back()
      ->with("success", "Kategori berhasil dihapus!");
  }
}