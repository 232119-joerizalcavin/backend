<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Gerbong extends Model
{
    protected $fillable = [
        'kode_gerbong',
        'jenis_gerbong',
        'kapasitas_maks',
        'nomor_seri',
        'lokasi',
        'tanggal_pembuatan',
        'status',
        'kondisi'
    ];

    public function barangKargos(): HasMany
    {
        return $this->hasMany(BarangKargo::class);
    }
}