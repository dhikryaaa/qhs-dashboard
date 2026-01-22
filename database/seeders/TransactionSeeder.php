<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            DB::table('qhs_inspect_h')->insert([
                [
                    'no_dokumen' => 'DOC001',
                    'tanggal' => now(),
                    'jam_mulai' => '00:00',
                    'kode_dept' => '00',
                    'kode_lokasi' => '00',
                    'user_input' => '000000'
                ]
            ]);

            DB::table('qhs_inspect_d')->insert([
                [
                    'no_dokumen' => 'DOC001',
                    'sub' => 1,
                    'kode' => '000',
                    'bukti_temuan' => 'Test Finding',
                    'deskripsi' => 'This is a test description for the inspection finding.',
                    'dokumen' => 'Test Document',
                    'referensi' => 'Test Reference',
                    'saran_koreksi' => 'Test Correction Suggestion',
                    'saran_korektif' => 'Test Corrective Suggestion',
                    'status' => 'Open'
                ]
            ]);
        });
    }
}
