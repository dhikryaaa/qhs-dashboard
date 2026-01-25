<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TransactionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::transaction(function () {
            // Generate random departments (01-05)
            $depts = ['01', '02', '03', '04', '05'];
            
            // ============================================
            // 1. Inspection on 6/13/2025
            // 4 issues: all closed (100% close rate)
            // ============================================
            $dept1 = $depts[array_rand($depts)];
            DB::table('qhs_inspect_h')->insert([
                [
                    'no_dokumen' => '000001',
                    'tanggal' => '2025-06-13',
                    'jam_mulai' => '08:00',
                    'kode_dept' => $dept1,
                    'kode_lokasi' => '00',
                    'user_input' => '000001'
                ]
            ]);

            DB::table('qhs_inspect_d')->insert([
                // Issue 1 - Closed (sub 1 = kategori 001)
                [
                    'no_dokumen' => '000001',
                    'sub' => 1,
                    'kode' => '001',
                    'bukti_temuan' => 'ini bukti temuan',
                    'deskripsi' => 'Ditemukan peralatan safety tidak sesuai standar di area produksi',
                    'dokumen' => 'Doc-001',
                    'referensi' => 'ISO-45001',
                    'saran_koreksi' => 'Ganti dengan peralatan yang certified',
                    'saran_korektif' => 'Implementasi sistem monitoring peralatan',
                    'tgl_perbaikan' => '2025-06-23',
                    'tgl_close' => '2025-06-23'
                ],
                // Issue 3 - Closed (sub 2 = kategori 002)
                [
                    'no_dokumen' => '000001',
                    'sub' => 2,
                    'kode' => '002',
                    'bukti_temuan' => 'ini bukti temuan',
                    'deskripsi' => 'Variasi dimensi produk melebihi toleransi yang diizinkan',
                    'dokumen' => 'Doc-003',
                    'referensi' => 'ISO-9001',
                    'saran_koreksi' => 'Kalibrasi mesin produksi',
                    'saran_korektif' => 'Implementasi SPC (Statistical Process Control)',
                    'tgl_perbaikan' => '2025-06-23',
                    'tgl_close' => '2025-06-23'
                ],
            ]);

            // ============================================
            // 2. Inspection on 10/27/2025
            // 2 issues: all closed (100% close rate)
            // ============================================
            $dept2 = $depts[array_rand($depts)];
            DB::table('qhs_inspect_h')->insert([
                [
                    'no_dokumen' => '000002',
                    'tanggal' => '2025-10-27',
                    'jam_mulai' => '09:00',
                    'kode_dept' => $dept2,
                    'kode_lokasi' => '00',
                    'user_input' => '000001'
                ]
            ]);

            DB::table('qhs_inspect_d')->insert([
                // Issue 1 - Closed (sub 1 = kategori 001)
                [
                    'no_dokumen' => '000002',
                    'sub' => 1,
                    'kode' => '001',
                    'bukti_temuan' => 'ini bukti temuan',
                    'deskripsi' => 'Beberapa karyawan tidak menggunakan APD secara lengkap',
                    'dokumen' => 'Doc-005',
                    'referensi' => 'Peraturan K3',
                    'saran_koreksi' => 'Sediakan APD lengkap untuk semua pekerja',
                    'saran_korektif' => 'Training APD dan enforcement policy',
                    'tgl_perbaikan' => '2025-10-29',
                    'tgl_close' => '2025-10-29'
                ],
                // Issue 2 - Closed (sub 2 = kategori 002)
                [
                    'no_dokumen' => '000002',
                    'sub' => 2,
                    'kode' => '002',
                    'bukti_temuan' => 'ini bukti temuan',
                    'deskripsi' => 'Batch produk hasil lab test tidak sesuai spesifikasi',
                    'dokumen' => 'Doc-006',
                    'referensi' => 'Spesifikasi Produk',
                    'saran_koreksi' => 'Reject batch dan investigasi penyebab',
                    'saran_korektif' => 'Implementasi 100% inspection untuk batch problematic',
                    'tgl_perbaikan' => '2025-10-29',
                    'tgl_close' => '2025-10-29'
                ]
            ]);

            // ============================================
            // 3. Inspection on 10/28/2025
            // 1 issue: closed (100% close rate)
            // ============================================
            $dept3 = $depts[array_rand($depts)];
            DB::table('qhs_inspect_h')->insert([
                [
                    'no_dokumen' => '000003',
                    'tanggal' => '2025-10-28',
                    'jam_mulai' => '10:00',
                    'kode_dept' => $dept3,
                    'kode_lokasi' => '00',
                    'user_input' => '000001'
                ]
            ]);

            DB::table('qhs_inspect_d')->insert([
                // Issue 1 - Closed (sub 1 = kategori 001)
                [
                    'no_dokumen' => '000003',
                    'sub' => 1,
                    'kode' => '001',
                    'bukti_temuan' => 'ini bukti temuan',
                    'deskripsi' => 'Udara di area produksi terasa pengap dan tidak ada sirkulasi yang baik',
                    'dokumen' => 'Doc-007',
                    'referensi' => 'Standar Ventilasi Industri',
                    'saran_koreksi' => 'Install sistem ventilasi tambahan',
                    'saran_korektif' => 'Maintenance ventilasi setiap bulan',
                    'tgl_perbaikan' => '2025-10-30',
                    'tgl_close' => '2025-10-30'
                ]
            ]);

            // ============================================
            // 4. Inspection on 11/15/2025 (mix of open & closed)
            // ============================================
            $dept4 = $depts[array_rand($depts)];
            DB::table('qhs_inspect_h')->insert([
                [
                    'no_dokumen' => '000004',
                    'tanggal' => '2025-11-15',
                    'jam_mulai' => '08:30',
                    'kode_dept' => $dept4,
                    'kode_lokasi' => '00',
                    'user_input' => '000001'
                ]
            ]);

            DB::table('qhs_inspect_d')->insert([
                // Issue 1 - Closed (sub 1 = kategori 001)
                [
                    'no_dokumen' => '000004',
                    'sub' => 1,
                    'kode' => '001',
                    'bukti_temuan' => 'ini bukti temuan',
                    'deskripsi' => 'First aid box di area kerja sudah expired dan isinya tidak lengkap',
                    'dokumen' => 'Doc-008',
                    'referensi' => 'Standar Pertolongan Pertama',
                    'saran_koreksi' => 'Ganti dengan first aid kit yang baru',
                    'saran_korektif' => 'Check first aid kit setiap 3 bulan',
                    'tgl_perbaikan' => '2025-11-17',
                    'tgl_close' => '2025-11-17'
                ],
                // Issue 2 - Still Open (sub 2 = kategori 002)
                [
                    'no_dokumen' => '000004',
                    'sub' => 2,
                    'kode' => '002',
                    'bukti_temuan' => 'ini bukti temuan',
                    'deskripsi' => 'Bahan baku yang masuk tidak memiliki sertifikat kualitas lengkap',
                    'dokumen' => 'Doc-009',
                    'referensi' => 'Prosedur Penerimaan Material',
                    'saran_koreksi' => 'Verifikasi sertifikat dengan supplier',
                    'saran_korektif' => 'Sistem automated supplier verification',
                    'tgl_perbaikan' => null,
                    'tgl_close' => null
                ]
            ]);
        });
    }
}