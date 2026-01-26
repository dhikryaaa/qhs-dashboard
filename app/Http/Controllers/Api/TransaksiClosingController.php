<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSInspectD;
use Illuminate\Http\Request;

class TransaksiClosingController extends Controller
{
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        [$no_dokumen, $sub] = explode(',', $id);

        $user = $request->user();

        $data = QHSInspectD::with([
            'inspectH:no_dokumen,tanggal,kode_lokasi,kode_dept',
            'inspectH.departemen:kode_dept,nama_dept',
            'inspectH.lokasi:kode_lokasi,nama_lokasi',
        ])->where('no_dokumen', $no_dokumen)->where('sub', (int) $sub)->firstOrFail();

        if ($data->status === 'Closed') {
            return response()->json([
                'message' => 'Inspeksi sudah dalam status Closed'
            ], 409);
        }

        $data->update([
            'status' => 'Closed',
            'tgl_close' => now(),
            'user_close' => $user->no_induk
        ]);

        return $data;
    }
}
