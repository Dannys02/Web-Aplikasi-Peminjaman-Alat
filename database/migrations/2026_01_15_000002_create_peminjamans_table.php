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
    Schema::create("peminjamans", function (Blueprint $table) {
      $table->id();
      $table->foreignId("user_id")->constrained("users"); // FK ke user
      $table->date("tanggal_pinjam");
      $table->date("durasi")->nullable();
      $table->date("tanggal_kembali")->nullable();
      // Ini sistem statusnya pakai ENUM
      $table
        ->enum("status", ["menunggu", "dipinjam", "dikembalikan"])
        ->default("menunggu");
      $table->timestamps();
    });
  }

  /**
   * Reverse the migrations.
   */
  public function down(): void
  {
    Schema::dropIfExists("peminjamans");
  }
};
