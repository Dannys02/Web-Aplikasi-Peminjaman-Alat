<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   */
  public function up(): void
  {
    Schema::create("log_aktivitas", function (Blueprint $table) {
      $table->id();
      $table->string("nama_user"); // Siapa pelakunya
      $table->string("peran"); // Admin atau Petugas
      $table->text("aksi"); // Apa yang dilakukan
      $table->timestamps(); // Tanggal & Waktu otomatis
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists("log_aktivitas");
  }
};
