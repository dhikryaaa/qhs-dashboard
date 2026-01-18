<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QHSInspectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('qhs_inspector')->insert([
            [
                'no_induk' => '000001',
                'nama' => 'Andik',
                'aktif' => 'Y'
            ],
            [
                'no_induk' => '000002',
                'nama' => 'Bambang',
                'aktif' => 'Y'
            ],
            [
                'no_induk' => '000003',
                'nama' => 'Cahyo',
                'aktif' => 'Y'
            ],
            [
                'no_induk' => '000004',
                'nama' => 'Doni',
                'aktif' => 'Y'
            ],
        ]);
    }
}
