<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlatController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PeminjamanController;

Route::get("/", function () {
  return view("welcome");
});

Route::get("/dashboard", [AlatController::class, "index"])
  ->middleware(["auth", "verified"])
  ->name("dashboard");

Route::post("/pinjam/{id}", [PeminjamanController::class, "store"])->name(
  "pinjam.alat"
);

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::post('/admin/konfirmasi/{id}', [PeminjamanController::class, 'konfirmasi'])->name('admin.konfirmasi');
    Route::post('/admin/kembalikan/{id}', [PeminjamanController::class, 'kembalikan'])->name('admin.kembalikan');
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
