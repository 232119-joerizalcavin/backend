<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BarangKargo extends Model
{
    protected $fillable = ['gerbong_id', 'nama_barang', 'nama_klien', 'berat_muatan', 'status'];

    public function gerbong(): BelongsTo
    {
        return $this->belongsTo(Gerbong::class);
    }
}
