<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSInspectD;
use Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TransaksiPerbaikanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->get('per_page', 5);

        $data = QHSInspectD::select(['no_dokumen', 'sub', 'bukti_perbaikan', 'saran_koreksi', 'saran_korektif', 'status', 'dokumen', 'tgl_perbaikan'])
            ->with([
                'inspectH:no_dokumen,tanggal,kode_lokasi',
                'inspectH.lokasi:kode_lokasi,nama_lokasi'
            ])
            ->paginate($page);

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        [$no_dokumen, $sub] = explode(',', $id);

        $data = QHSInspectD::select(['no_dokumen', 'sub', 'bukti_perbaikan', 'saran_koreksi', 'saran_korektif', 'status', 'dokumen', 'tgl_perbaikan'])
            ->with([
                'inspectH:no_dokumen,tanggal,kode_lokasi',
                'inspectH.lokasi:kode_lokasi,nama_lokasi',
            ])
            ->where('no_dokumen', $no_dokumen)
            ->where('sub', (int) $sub)
            ->firstOrFail();

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        [$no_dokumen, $sub] = explode(',', $id);
        $sub = (int) $sub;

        $validation = $request->validate([
            'bukti_perbaikan' => 'sometimes|nullable|string',
        ]);
        $validation['tgl_perbaikan'] = $request->input('tgl_perbaikan', Date::now());

        // Ensure we get the exact record
        QHSInspectD::where('no_dokumen', $no_dokumen)
            ->where('sub', $sub)
            ->update($validation);

        // Update only this specific record
        return QHSInspectD::where('no_dokumen', $no_dokumen)->where('sub', $sub)->with([
            'inspectH:no_dokumen,tanggal,kode_lokasi',
            'inspectH.lokasi:kode_lokasi,nama_lokasi'
        ])
        ->firstOrFail();
    }
}
