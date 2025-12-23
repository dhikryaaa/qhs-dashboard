<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QHSDepartemenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('qhs_departemen')->insert([
            [
                'kode_dept' => '01',
                'nama_dept' => 'Marketing',
                'aktif' => 'Y'
            ],
            [
                'kode_dept' => '02',
                'nama_dept' => 'Produksi 1',
                'aktif' => 'Y'
            ],
            [
                'kode_dept' => '03',
                'nama_dept' => 'Produksi 2',
                'aktif' => 'Y'
            ],
            [
                'kode_dept' => '04',
                'nama_dept' => 'Logistik',
                'aktif' => 'Y'
            ],
            [
                'kode_dept' => '05',
                'nama_dept' => 'QHS',
                'aktif' => 'Y'
            ],
        ]);
    }
}
