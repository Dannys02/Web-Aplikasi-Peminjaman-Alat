<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogAktivitas extends Model
{
  protected $fillable = ["nama_user", "peran", "aksi"];
}
