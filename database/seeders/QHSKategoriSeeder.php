<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QHSKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('qhs_kategori')->insert([
            [
                'kode' => '001',
                'nama' => 'Mutu',
                'aktif' => 'Y'
            ],
            [
                'kode' => '002',
                'nama' => 'K3',
                'aktif' => 'Y'
            ],
            [
                'kode' => '003',
                'nama' => 'SR',
                'aktif' => 'Y'
            ],
        ]);
    }
}
