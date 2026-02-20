<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSCounter;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class QHSCounterController extends Controller
{
    public function generateNomor()
    {
        return DB::transaction(function () {
            $kode = 'INS';
            $bulan = strtoupper(
                Carbon::now()->locale('id')->translatedFormat('M')
            );
            $tahun = Carbon::now()->year;
            
            $lastKonter = QHSCounter::where('kode', $kode)
                ->where('bulan', $bulan)
                ->where('tahun', $tahun)
                ->lockForUpdate()
                ->max('konter');

            $konter = $lastKonter ? $lastKonter + 1 : 000001; 

            $nomor = sprintf('%s%s%s%06d', $kode, $bulan, $tahun, $konter);

            QHSCounter::create([
                'kode' => $kode,
                'bulan' => $bulan,
                'tahun' => $tahun,
                'konter' => $konter,
                'nomor' => $nomor
            ]);

            return $nomor;
        });
    }
}
