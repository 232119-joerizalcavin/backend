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
        Schema::table('gerbongs', function (Blueprint $table) {
            $table->enum('status', ['Aktif', 'Maintenance', 'Pensiun'])->default('Aktif')->after('kapasitas_maks');
            $table->string('lokasi')->nullable()->after('status');
            $table->string('nomor_seri')->nullable()->unique()->after('lokasi');
            $table->date('tanggal_pembuatan')->nullable()->after('nomor_seri');
            $table->enum('kondisi', ['Baik', 'Perlu Perbaikan', 'Rusak'])->default('Baik')->after('tanggal_pembuatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gerbongs', function (Blueprint $table) {
            $table->dropColumn(['status', 'lokasi', 'nomor_seri', 'tanggal_pembuatan', 'kondisi']);
        });
    }
};
