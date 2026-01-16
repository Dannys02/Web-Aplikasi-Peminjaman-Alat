<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
  protected $table = "peminjamans";

  protected $fillable = [
    "user_id",
    "tanggal_pinjam",
    "durasi",
    "tanggal_kembali",
    "status",
  ];

  public function user()
  {
    return $this->belongsTo(User::class);
  }

  // Relasi Many-to-Many ke Alat lewat tabel detail
  public function alats()
  {
    return $this->belongsToMany(Alat::class, "detail_peminjamans")->withPivot(
      "jumlah"
    ); // Penting untuk tahu jumlah per alat
  }
}
