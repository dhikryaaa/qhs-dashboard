<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QHSLokasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('qhs_lokasi')->insert([
            [
                'kode_lokasi' => '01',
                'nama_lokasi' => 'Kantor',
                'aktif' => 'Y'
            ],
            [
                'kode_lokasi' => '02',
                'nama_lokasi' => 'Gudang',
                'aktif' => 'Y'
            ],
            [
                'kode_lokasi' => '03',
                'nama_lokasi' => 'Lorong',
                'aktif' => 'Y'
            ],
            [
                'kode_lokasi' => '04',
                'nama_lokasi' => 'Panel',
                'aktif' => 'Y'
            ],
        ]);
    }
}
