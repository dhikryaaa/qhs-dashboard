<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSInspectD;
use Illuminate\Http\Request;

class TransaksiInspeksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->get('per_page', 5);
        $filter = $request->get('departemen');

        $data = QHSInspectD::with([
            'inspectH.departemen:kode_dept,nama_dept',
            'inspectH.lokasi:kode_lokasi,nama_lokasi',
        ]);

        if ($filter) {
            $data->whereHas('inspectH.departemen', function ($query) use ($filter) {
                $query->where('nama_dept', $filter);
            });
        }

        return $data->paginate($page);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        [$no_dokumen, $sub] = explode(',', $id);

        $data = QHSInspectD::with([
            'inspectH.departemen:kode_dept,nama_dept',
            'inspectH.lokasi:kode_lokasi,nama_lokasi',
        ])->where('no_dokumen', $no_dokumen)->where('sub', (int) $sub)->firstOrFail();

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        [$no_dokumen, $sub] = explode(',', $id);

        $data = QHSInspectD::with([
            'inspectH.departemen:kode_dept,nama_dept',
            'inspectH.lokasi:kode_lokasi,nama_lokasi',
        ])->where('no_dokumen', $no_dokumen)->where('sub', (int) $sub)->firstOrFail();

        $validation = $request->validate([
            'dokumen' => 'sometimes|nullable|string',
            'referensi' => 'sometimes|nullable|string',
            'saran_koreksi' => 'sometimes|nullable|string',
            'saran_korektif' => 'sometimes|nullable|string',
            'status' => 'sometimes|nullable|string',
        ]);

        $data->update($validation);

        return $data;
    }
}
