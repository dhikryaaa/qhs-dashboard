<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(QHSRoleSeeder::class);
        $this->call(QHSDepartemenSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(QHSInspectorSeeder::class);
        $this->call(QHSLokasiSeeder::class);
        $this->call(QHSKategoriSeeder::class);
    }
}
