<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSInspectD;
use App\Models\QHSInspectH;
use Illuminate\Support\Facades\DB;
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
            'inspectH:no_dokumen,tanggal,kode_lokasi,kode_dept',
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
            'inspectH:no_dokumen,tanggal,kode_lokasi,kode_dept',
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
        $sub = (int) $sub;

        $validation = $request->validate([
            'dokumen' => 'sometimes|nullable|string',
            'referensi' => 'sometimes|nullable|string',
            'deskripsi' => 'sometimes|nullable|string',
            'saran_koreksi' => 'sometimes|nullable|string',
            'saran_korektif' => 'sometimes|nullable|string',
            'status' => 'sometimes|nullable|string',
            'kode_dept' => 'sometimes|nullable|string',
            'kode_lokasi' => 'sometimes|nullable|string',
        ]);

        // Start transaction
        DB::beginTransaction();
        try {
            // Update QHSInspectH if kode_dept or kode_lokasi is provided
            if (isset($validation['kode_dept']) || isset($validation['kode_lokasi'])) {
                $inspectH_updates = [];
                
                if (isset($validation['kode_dept'])) {
                    $inspectH_updates['kode_dept'] = $validation['kode_dept'];
                    unset($validation['kode_dept']);
                }
                
                if (isset($validation['kode_lokasi'])) {
                    $inspectH_updates['kode_lokasi'] = $validation['kode_lokasi'];
                    unset($validation['kode_lokasi']);
                }

                QHSInspectH::where('no_dokumen', $no_dokumen)
                    ->update($inspectH_updates);
            }

            // Update QHSInspectD
            QHSInspectD::where('no_dokumen', $no_dokumen)
                ->where('sub', $sub)
                ->update($validation);

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

        return QHSInspectD::where('no_dokumen', $no_dokumen)->where('sub', $sub)->with([
            'inspectH:no_dokumen,tanggal,kode_lokasi,kode_dept',
            'inspectH.departemen:kode_dept,nama_dept',
            'inspectH.lokasi:kode_lokasi,nama_lokasi',
        ])->firstOrFail();
    }

    /**
     * Delete the specified resource from storage.
     */
    public function destroy(string $id)
    {
        [$no_dokumen, $sub] = explode(',', $id);
        $sub = (int) $sub;

        QHSInspectD::where('no_dokumen', $no_dokumen)
            ->where('sub', $sub)
            ->delete();

        return response()->json([
            'message' => 'Data inspeksi berhasil dihapus'
        ], 200);
    }
}
