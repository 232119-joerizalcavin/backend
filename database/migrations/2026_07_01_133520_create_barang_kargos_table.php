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
    Schema::create('barang_kargos', function (Blueprint $table) {
        $table->id();
        // Relasi Foreign Key ke tabel gerbongs
        $table->foreignId('gerbong_id')->constrained('gerbongs')->onDelete('cascade');
        $table->string('nama_barang');           // Contoh: Semen Tiga Roda
        $table->string('nama_klien');            // Contoh: PT. Tiga Roda Logistik
        $table->integer('berat_muatan');         // Berat dalam Ton
        $table->string('status');                // Contoh: Siap Berangkat / Bongkar
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_kargos');
    }
};
