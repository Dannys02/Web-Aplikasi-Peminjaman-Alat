<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Peminjamans;

class AlatController extends Controller
{
  public function index()
  {
    // Mengambil semua data alat beserta kategorinya (Eager Loading)
    $semuaAlat = Alat::with("kategori")->get();

    $historySaya = \App\Models\Peminjamans::where("user_id", auth()->id())
      ->with("alats")
      ->latest()
      ->get();

    // Mengirim data ke view dashboard
    return view("dashboard", compact("semuaAlat"));
  }
}
