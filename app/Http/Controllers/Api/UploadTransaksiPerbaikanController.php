<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSInspectD;
use Illuminate\Http\Request;

class UploadTransaksiPerbaikanController extends Controller
{
    /**
     * Upload file for bukti perbaikan
     */
    public function uploadFile(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:5120', // max 5MB
            'no_dokumen' => 'required|string',
            'sub' => 'required|integer'
        ]);

        $file = $request->file('file');
        $no_dokumen = $request->input('no_dokumen');
        $sub = $request->input('sub');

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

            // Update database with filename
            QHSInspectD::where('no_dokumen', $no_dokumen)
                ->where('sub', $sub)
                ->update(['bukti_perbaikan' => $filename]);

            // Return filename (will be stored in bukti_perbaikan char(20) field)
            $filePath = $storagePath . '/' . $filename;

            return response()->json([
                'success' => true,
                'file_path' => $filePath,
                'file_name' => $filename,
                'file_url' => '/storage/' . $filePath,
                'message' => 'File berhasil diupload dan database terupdate'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal upload file: ' . $e->getMessage()
            ], 500);
        }
    }
}
