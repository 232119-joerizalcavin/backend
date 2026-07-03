<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\BarangKargo;

class BarangKargoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangKargos = [
            [
                'gerbong_id' => 1,
                'nama_barang' => 'Besi Beton Diameter 12mm',
                'nama_klien' => 'PT. Besi Indonesia Maju',
                'berat_muatan' => 35,
                'status' => 'Siap Berangkat',
            ],
            [
                'gerbong_id' => 1,
                'nama_barang' => 'Batu Kapur untuk Konstruksi',
                'nama_klien' => 'PT. Semen Tuban',
                'berat_muatan' => 39,
                'status' => 'Bongkar',
            ],
            [
                'gerbong_id' => 2,
                'nama_barang' => 'Bahan Bakar Solar (Solar Diesel)',
                'nama_klien' => 'PT. Pertamina Logistik',
                'berat_muatan' => 48,
                'status' => 'Perjalanan',
            ],
            [
                'gerbong_id' => 3,
                'nama_barang' => 'Semen Portland untuk Bangunan',
                'nama_klien' => 'PT. Holcim Indonesia',
                'berat_muatan' => 0,
                'status' => 'Kosong',
            ],
            [
                'gerbong_id' => 4,
                'nama_barang' => 'Kayu Lapis Industri',
                'nama_klien' => 'PT. Kayu Pontianak',
                'berat_muatan' => 28,
                'status' => 'Perjalanan',
            ],
            [
                'gerbong_id' => 4,
                'nama_barang' => 'Terigu Berkualitas Tinggi',
                'nama_klien' => 'PT. Bogasari Flour Mills',
                'berat_muatan' => 29,
                'status' => 'Perjalanan',
            ],
            [
                'gerbong_id' => 5,
                'nama_barang' => 'Pupuk NPK untuk Pertanian',
                'nama_klien' => 'PT. Pupuk Kalimantan Timur',
                'berat_muatan' => 42,
                'status' => 'Siap Berangkat',
            ],
        ];

        foreach ($barangKargos as $barangKargo) {
            BarangKargo::create($barangKargo);
        }
    }
}
