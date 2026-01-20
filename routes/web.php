<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\UserController;

Route::get("/", function () {
  return view("welcome");
});

Route::get("/dashboard", [AlatController::class, "index"])
  ->middleware(["auth", "verified"])
  ->name("dashboard");

Route::middleware(["auth", "role:admin"])->group(function () {
  // CRUD USERS
  Route::get("/admin/users", [UserController::class, "index"])->name(
    "admin.users.index"
  );
  Route::post("/admin/users", [UserController::class, "store"])->name(
    "admin.users.store"
  );
  Route::put("/admin/users/{id}", [UserController::class, "update"])->name(
    "admin.users.update"
  );
  Route::delete("/admin/users/{id}", [UserController::class, "destroy"])->name(
    "admin.users.destroy"
  );

  // CRUD ALAT
  Route::get("/admin/tambah-alat", [AlatController::class, "create"])->name(
    "admin.tambah.alat"
  );
  Route::post("/admin/simpan-alat", [AlatController::class, "store"])->name(
    "admin.simpan.alat"
  );
  Route::put("/admin/alat/{id}", [AlatController::class, "update"])->name(
    "admin.alat.update"
  );
  Route::delete("/admin/alat/{id}", [AlatController::class, "destroy"])->name(
    "admin.alat.destroy"
  );

  // CRUD KATEGORI
  Route::get("/admin/kategori", [KategoriController::class, "index"])->name(
    "admin.kategori.index"
  );
  Route::post("/admin/kategori/store", [
    KategoriController::class,
    "store",
  ])->name("admin.kategori.store");
  Route::put("/admin/kategori/{id}", [
    KategoriController::class,
    "update",
  ])->name("admin.kategori.update");
  Route::delete("/admin/kategori/{id}", [
    KategoriController::class,
    "destroy",
  ])->name("admin.kategori.destroy");

  // LOG AKTIFITAS
  Route::get("/admin/log", function () {
    return view("admin.log");
  })->name("admin.log.user");
});

Route::middleware(["auth", "role:petugas"])->group(function () {
  // KONFIRMASI PINJAMAN
  Route::post("/petugas/konfirmasi/{id}", [
    PeminjamanController::class,
    "konfirmasi",
  ])->name("petugas.konfirmasi");
  // KONFIRMASI KEMBALIKAN
  Route::post("/petugas/konfirmasi-kembali/{id}", [
    PeminjamanController::class,
    "konfirmasiKembalikan",
  ])->name("petugas.konfirmasi_kembali");
  // LAPORAN ADMIN
  Route::get("/petugas/laporan", [LaporanController::class, "index"])->name(
    "petugas.laporan.index"
  );
});

Route::middleware(["auth", "role:peminjam"])->group(function () {
  // PINJAM
  Route::post("/pinjam/{id}", [PeminjamanController::class, "store"])->name(
    "pinjam.alat"
  );
  // KEMBALIKAN
  Route::post("/peminjam/kembalikan/{id}", [
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
