<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QHSRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('qhs_role')->insert([
            [
                'kode_role' => '01',
                'nama' => 'Adm Dept',
                'aktif' => 'Y'
            ],
            [
                'kode_role' => '02',
                'nama' => 'Adm QHS',
                'aktif' => 'Y'
            ]
        ]);
    }
}
