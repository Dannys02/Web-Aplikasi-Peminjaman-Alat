<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alat extends Model
{
  protected $fillable = ["kategori_id", "nama_alat", "jumlah"];

  public function kategori()
  {
    return $this->belongsTo(Kategori::class);
  }

  public function peminjamans()
  {
    // Alat bisa muncul di banyak transaksi peminjaman
    return $this->belongsToMany(Peminjaman::class, "detail_peminjamans");
  }
}
