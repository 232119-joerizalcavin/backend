<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Gerbong;

class GerbongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $gerbongs = [
            [
                'kode_gerbong' => 'PPCW-4201 ACC',
                'jenis_gerbong' => 'Gerbong Datar (Flatcar Baja)',
                'kapasitas_maks' => 40,
                'nomor_seri' => 'SN-2020-001',
                'lokasi' => 'Depot Jakarta',
                'tanggal_pembuatan' => '2020-01-15',
                'status' => 'Aktif',
                'kondisi' => 'Baik',
            ],
            [
                'kode_gerbong' => 'ZZW-8910 KAI',
                'jenis_gerbong' => 'Gerbong Tangki Bahan Bakar',
                'kapasitas_maks' => 50,
                'nomor_seri' => 'SN-2019-042',
                'lokasi' => 'Depot Surabaya',
                'tanggal_pembuatan' => '2019-06-20',
                'status' => 'Aktif',
                'kondisi' => 'Baik',
            ],
            [
                'kode_gerbong' => 'PPCW-4205 ACC',
                'jenis_gerbong' => 'Gerbong Datar (Flatcar Baja)',
                'kapasitas_maks' => 40,
                'nomor_seri' => 'SN-2021-015',
                'lokasi' => 'Depot Bandung',
                'tanggal_pembuatan' => '2021-03-10',
                'status' => 'Aktif',
                'kondisi' => 'Perlu Perbaikan',
            ],
            [
                'kode_gerbong' => 'GG-3001 KAI',
                'jenis_gerbong' => 'Gerbong Tertutup (Covered Wagon)',
                'kapasitas_maks' => 30,
                'nomor_seri' => 'SN-2018-088',
                'lokasi' => 'Depot Medan',
                'tanggal_pembuatan' => '2018-11-25',
                'status' => 'Maintenance',
                'kondisi' => 'Perlu Perbaikan',
            ],
            [
                'kode_gerbong' => 'TT-5005 ACC',
                'jenis_gerbong' => 'Gerbong Gondola (Open Sided)',
                'kapasitas_maks' => 45,
                'nomor_seri' => 'SN-2022-003',
                'lokasi' => 'Depot Semarang',
                'tanggal_pembuatan' => '2022-05-08',
                'status' => 'Aktif',
                'kondisi' => 'Baik',
            ],
        ];

        foreach ($gerbongs as $gerbong) {
            Gerbong::create($gerbong);
        }
    }
}
