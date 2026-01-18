<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;

Route::get("/", function () {
  return view("welcome");
});

Route::get("/dashboard", [AlatController::class, "index"])
  ->middleware(["auth", "verified"])
  ->name("dashboard");

Route::post("/pinjam/{id}", [PeminjamanController::class, "store"])->name(
  "pinjam.alat"
);

Route::middleware(["auth", "role:admin"])->group(function () {
  // CRUD ALAT
  Route::get("/admin/tambah-alat", [AlatController::class, "create"])->name(
    "admin.tambah.alat"
  );
  Route::post("/admin/simpan-alat", [AlatController::class, "store"])->name(
    "admin.simpan.alat"
  );

  // CRUD KATEGORI
  Route::get("/admin/kategori", [KategoriController::class, "index"])->name(
    "admin.kategori.index"
  );
  Route::post("/admin/kategori", [KategoriController::class, "store"])->name(
    "admin.kategori.store"
  );
  Route::delete("/admin/kategori/{id}", [
    KategoriController::class,
    "destroy",
  ])->name("admin.kategori.destroy");
});

Route::middleware(["auth", "role:petugas"])->group(function () {
  // KONFIRMASI PINJAMAN
  Route::post("/admin/konfirmasi/{id}", [
    PeminjamanController::class,
    "konfirmasi",
  ])->name("admin.konfirmasi");
  // KONFIRMASI KEMBALIKAN
  Route::post("/admin/konfirmasi-kembali/{id}", [
    PeminjamanController::class,
    "konfirmasiKembalikan",
  ])->name("admin.konfirmasi_kembali");
  // LAPORAN ADMIN
  Route::get("/admin/laporan", [LaporanController::class, "index"])->name(
    "admin.laporan.index"
  );
});

Route::middleware(["auth", "role:peminjam"])->group(function () {
  // KEMBALIKAN
  Route::post("/admin/kembalikan/{id}", [
    PeminjamanController::class,
    "kembalikan",
  ])->name("user.kembalikan");
});

Route::middleware("auth")->group(function () {
  Route::get("/profile", [ProfileController::class, "edit"])->name(
    "profile.edit"
  );
  Route::patch("/profile", [ProfileController::class, "update"])->name(
    "profile.update"
  );
  Route::delete("/profile", [ProfileController::class, "destroy"])->name(
    "profile.destroy"
  );
});

require __DIR__ . "/auth.php";
