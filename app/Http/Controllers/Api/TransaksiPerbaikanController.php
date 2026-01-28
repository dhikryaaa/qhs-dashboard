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

        $data = QHSInspectD::select(['no_dokumen', 'sub', 'bukti_temuan', 'bukti_perbaikan', 'saran_koreksi', 'saran_korektif', 'status', 'dokumen', 'tgl_perbaikan'])
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

        $data = QHSInspectD::select(['no_dokumen', 'sub', 'bukti_temuan', 'bukti_perbaikan', 'saran_koreksi', 'saran_korektif', 'status', 'dokumen', 'tgl_perbaikan'])
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
     * Upload file for bukti perbaikan
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
        
        // Define storage path - fixed path in public/storage/bukti_perbaikan
        $storagePath = 'bukti_perbaikan';
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
            
            // Return filename (will be stored in bukti_perbaikan char(20) field)
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
