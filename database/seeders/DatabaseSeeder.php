<?php

namespace Database\Seeders;

use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
  public function run(): void
  {
    // 1. Buat Role (Urutan ID penting!)
    $adminRole = Role::create(["nama_role" => "admin"]); // ID: 1
    $peminjamRole = Role::create(["nama_role" => "peminjam"]); // ID: 2

    // 2. Buat Satu User Admin untuk login pertama kali
    User::create([
      "role_id" => $adminRole->id,
      "name" => "Admin",
      "email" => "admin@gmail.com",
      "password" => Hash::make("password123"),
    ]);

    // 3. Buat Satu User Peminjam (Siswa)
    User::create([
      "role_id" => $peminjamRole->id,
      "name" => "Budi Siswa",
      "email" => "budi@gmail.com",
      "password" => Hash::make("password123"),
    ]);

    // 4. Buat Kategori dan Alat contoh
    $kat = Kategori::create(["nama_kategori" => "Elektronik"]);

    Alat::create([
      "kategori_id" => $kat->id,
      "nama_alat" => "Proyektor Epson",
      "jumlah" => 10,
    ]);

    Alat::create([
      "kategori_id" => $kat->id,
      "nama_alat" => "Kabel HDMI 5m",
      "jumlah" => 5,
    ]);
  }
}
