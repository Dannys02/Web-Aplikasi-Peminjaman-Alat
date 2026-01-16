<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
  protected $fillable = ["nama_role"];

  // Relasi: Satu Role punya BANYAK User
  public function users()
  {
    return $this->hasMany(User::class);
  }
}
