<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSLokasi;
use Illuminate\Http\Request;

class QHSLokasiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $page = $request->get('page', 1);
        $search = $request->get('search', '');

        $query = QHSLokasi::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_lokasi', 'like', '%' . $search . '%')
                  ->orWhere('nama_lokasi', 'like', '%' . $search . '%');
            });
        }

        $data = $query->paginate($perPage, ['*'], 'page', $page);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'kode_lokasi' => 'required|string|unique:qhs_lokasi,kode_lokasi',
            'nama_lokasi' => 'required|string',
            'aktif' => 'required|string'
        ]);

        $data = QHSLokasi::create($validation);

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = QHSLokasi::where('kode_lokasi', $id)->firstOrFail();

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = QHSLokasi::where('kode_lokasi', $id)->firstOrFail();

        $validation = $request->validate([
            'nama_lokasi' => 'sometimes|required|string',
            'aktif' => 'sometimes|required|string'
        ]);

        $data->update($validation);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = QHSLokasi::where('kode_lokasi', $id)->firstOrFail();
        $data->delete();

        return response()->json([
            'message' => 'Lokasi berhasil dihapus'
        ]);
    }
}
