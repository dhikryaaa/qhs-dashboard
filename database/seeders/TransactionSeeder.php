<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionSeeder extends Seeder
{
    public function run(): void
    {
        DB::transaction(function () {

            $depts = ['01', '02', '03', '04', '05'];
            
            $insertHeader = function ($no, $tgl) use ($depts) {
                DB::table('qhs_inspect_h')->insert([
                    'no_dokumen' => $no,
                    'tanggal' => $tgl,
                    'jam_mulai' => '08:00',
                    'kode_dept' => $depts[array_rand($depts)],
                    'kode_lokasi' => '00',
                    'user_input' => '000001'
                ]);
            };

            $insertDetail = function (
                $no,
                $kode,
                $sub,
                $close = true,
                $tglPerbaikan = null
            ) {
                DB::table('qhs_inspect_d')->insert([
                    'no_dokumen' => $no,
                    'sub' => $sub,
                    'kode' => $kode,
                    'bukti_temuan' => 'dummy bukti',
                    'deskripsi' => "Temuan kategori {$kode}",
                    'dokumen' => 'DOC',
                    'referensi' => $kode === '001' ? 'ISO 45001' : 'ISO 9001',
                    'saran_koreksi' => 'Perbaikan segera',
                    'saran_korektif' => 'Preventive action',
                    'tgl_perbaikan' => $close ? $tglPerbaikan : null,
                    'tgl_close' => $close ? $tglPerbaikan : null,
                ]);
            };

            $insertHeader('DOC-001', '2025-06-13');
            $insertDetail('DOC-001', '001', 1, true, '2025-06-20');
            $insertDetail('DOC-001', '002', 2, true, '2025-06-20');
            $insertHeader('DOC-002', '2025-06-13');
            $insertDetail('DOC-002', '001', 1, false, '2025-06-20');
            $insertDetail('DOC-002', '002', 2, true, '2025-06-20');

            $insertHeader('DOC-003', '2025-07-10');
            $insertDetail('DOC-003', '001', 1, true, '2025-07-18');
            $insertDetail('DOC-003', '002', 2, false);
            $insertHeader('DOC-004', '2025-07-10');
            $insertDetail('DOC-004', '001', 1, false);
            $insertDetail('DOC-004', '002', 2, true, '2025-07-18');
        });
    }
}
