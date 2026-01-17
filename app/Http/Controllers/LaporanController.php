<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class LaporanController extends Controller
{
    public function index()
    {
        // Mengambil semua data peminjaman beserta relasi user dan alat
        $semuaLaporan = Peminjaman::with(['user', 'alats'])->latest()->get();
        return view('admin.laporan-admin', compact('semuaLaporan'));
    }
}
