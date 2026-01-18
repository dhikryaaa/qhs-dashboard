<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'no_induk'   => '000002',
                'nama'       => 'Bambang',
                'aktif'      => 'Y',
                'kode_role'  => '02',
                'kode_dept'  => '05',
                'password'   => Hash::make('password123'),
            ],
            [
                'no_induk'   => '000003',
                'nama'       => 'Cahyo',
                'aktif'      => 'Y',
                'kode_role'  => '02',
                'kode_dept'  => '05',
                'password'   => Hash::make('password123'),
            ],
            [
                'no_induk'   => '000005',
                'nama'       => 'Endang',
                'aktif'      => 'Y',
                'kode_role'  => '01',
                'kode_dept'  => '02',
                'password'   => Hash::make('password123'),
            ],
            [
                'no_induk'   => '000006',
                'nama'       => 'Farid',
                'aktif'      => 'Y',
                'kode_role'  => '01',
                'kode_dept'  => '04',
                'password'   => Hash::make('password123'),
            ],
            [
                'no_induk'   => '000007',
                'nama'       => 'Gordon',
                'aktif'      => 'Y',
                'kode_role'  => '01',
                'kode_dept'  => '01',
                'password'   => Hash::make('password123'),
            ],
        ]);
    }
}
