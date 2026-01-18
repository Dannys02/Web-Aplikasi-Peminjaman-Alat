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
    // Buat Role (Urutan ID penting!)
    $adminRole = Role::create(["nama_role" => "admin"]); // ID: 1
    
    $petugasRole = Role::create(["nama_role" => "petugas"]); // ID: 2
    
    $peminjamRole = Role::create(["nama_role" => "peminjam"]); // ID : 3

    // Buat Satu User Admin untuk login pertama kali
    User::create([
      "role_id" => $adminRole->id,
      "name" => "Admin",
      "email" => "admin@gmail.com",
      "password" => Hash::make("password"),
    ]);

    // Buat Satu User Peminjam (Siswa)
    User::create([
      "role_id" => $peminjamRole->id,
      "name" => "Siswa",
      "email" => "siswa@gmail.com",
      "password" => Hash::make("password"),
    ]);
    
    // Buat Satu User Petugas (Petugas)
    User::create([
      "role_id" => $petugasRole->id,
      "name" => "Petugas",
      "email" => "petugas@gmail.com",
      "password" => Hash::make("password"),
    ]);

    // Buat Kategori dan Alat contoh
    $katElectro = Kategori::create(["nama_kategori" => "Elektronik"]);
    
    $katBook = Kategori::create(["nama_kategori" => "Buku"]);

    Alat::create([
      "kategori_id" => $katElectro->id,
      "nama_alat" => "Proyektor Epson",
      "jumlah" => 5,
    ]);

    Alat::create([
      "kategori_id" => $katElectro->id,
      "nama_alat" => "Kabel HDMI 5m",
      "jumlah" => 5,
    ]);
    
    Alat::create([
      "kategori_id" => $katBook->id,
      "nama_alat" => "Buku Kancil",
      "jumlah" => 5,
    ]);
  }
}
