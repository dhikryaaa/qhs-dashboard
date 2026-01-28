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
        $sub = (int) $sub;

        $user = $request->user();
        
        $data = QHSInspectD::where('no_dokumen', $no_dokumen)
            ->where('sub', $sub)
            ->get('status');

        if ($data === 'Closed') {
            return response()->json([
                'message' => 'Inspeksi sudah dalam status Closed'
            ], 409);
        }

        QHSInspectD::where('no_dokumen', $no_dokumen)
            ->where('sub', $sub)
            ->update([
                'status' => 'Closed',
                'tgl_close' => now(),
                'user_close' => $user->no_induk
            ]);

        return QHSInspectD::where('no_dokumen', $no_dokumen)->where('sub', $sub)->with([
            'inspectH:no_dokumen,tanggal,kode_lokasi',
            'inspectH.lokasi:kode_lokasi,nama_lokasi'
        ])->firstOrFail();
    }
}
