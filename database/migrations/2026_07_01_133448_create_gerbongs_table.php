<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
  public function up(): void
{
    Schema::create('gerbongs', function (Blueprint $table) {
        $table->id();
        $table->string('kode_gerbong')->unique(); // Contoh: PPCW-4201
        $table->string('jenis_gerbong');        // Contoh: Gerbong Datar / Gerbong Tertutup
        $table->integer('kapasitas_maks');       // Kapasitas dalam Ton
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gerbongs');
    }
};
