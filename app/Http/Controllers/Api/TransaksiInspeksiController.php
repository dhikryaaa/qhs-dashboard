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
     * Upload file for bukti temuan
     */
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120', // max 5MB
            'no_dokumen' => 'required|string',
        ]);

        $file = $request->file('file');
        $no_dokumen = $request->input('no_dokumen');

        // Create filename: no_dokumen.extension
        $ext = $file->getClientOriginalExtension();
        $filename = $no_dokumen . '.' . $ext;

        // Define storage path - fixed path in public/storage/bukti_temuan
        $storagePath = 'bukti_temuan';
        $fullStoragePath = storage_path('app/public/' . $storagePath);

        // Ensure directory exists
        if (!is_dir($fullStoragePath)) {
            mkdir($fullStoragePath, 0755, true);
        }

        try {
            // Delete old files with same dokumen number
            $oldFiles = glob($fullStoragePath . '/' . $no_dokumen . '.*');
            foreach ($oldFiles as $oldFile) {
                if (is_file($oldFile)) {
                    unlink($oldFile);
                }
            }

            // Store new file
            $file->move($fullStoragePath, $filename);

            // Return filename (will be stored in bukti_temuan char(20) field)
            $filePath = $storagePath . '/' . $filename;

            return response()->json([
                'success' => true,
                'file_path' => $filePath,
                'file_name' => $filename,
                'file_url' => '/storage/' . $filePath,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal upload file: ' . $e->getMessage()
            ], 500);
        }
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
            'deskripsi' => 'sometimes|string',
            'saran_koreksi' => 'sometimes|nullable|string',
            'saran_korektif' => 'sometimes|nullable|string',
            'status' => 'sometimes|nullable|string',
            'kode_dept' => 'sometimes|string',
            'kode_lokasi' => 'sometimes|nullable|string',
            'bukti_temuan' => 'sometimes|string',
        ]);

        // Start transaction
        DB::beginTransaction();
        try {
            $inspectH_updates = [];

            if ($request->has('kode_dept')) {
                $inspectH_updates['kode_dept'] = $validation['kode_dept'];
            }

            if ($request->exists('kode_lokasi')) {
                $inspectH_updates['kode_lokasi'] = $validation['kode_lokasi'];
            }

            if (!empty($inspectH_updates)) {
                QHSInspectH::where('no_dokumen', $no_dokumen)
                    ->update($inspectH_updates);
            }
            
            $inspectD_updates = [];

            if ($request->exists('dokumen')) {
                $inspectD_updates['dokumen'] = $validation['dokumen'];
            }

            if ($request->exists('referensi')) {
                $inspectD_updates['referensi'] = $validation['referensi'];
            }

            if ($request->has('deskripsi')) {
                $inspectD_updates['deskripsi'] = $validation['deskripsi'];
            }

            if ($request->exists('saran_koreksi')) {
                $inspectD_updates['saran_koreksi'] = $validation['saran_koreksi'];
            }

            if ($request->exists('saran_korektif')) {
                $inspectD_updates['saran_korektif'] = $validation['saran_korektif'];
            }

            if ($request->exists('status')) {
                $inspectD_updates['status'] = $validation['status'];
            }

            if ($request->filled('bukti_temuan')) {
                $inspectD_updates['bukti_temuan'] = $validation['bukti_temuan'];
            }

            if (!empty($inspectD_updates)) {
                QHSInspectD::where('no_dokumen', $no_dokumen)
                    ->where('sub', $sub)
                    ->update($inspectD_updates);
            }

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
