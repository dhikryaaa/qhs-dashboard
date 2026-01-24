<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSKategori;
use Illuminate\Http\Request;

class QHSKategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $page = $request->get('page', 1);
        $search = $request->get('search', '');

        $query = QHSKategori::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode', 'like', '%' . $search . '%')
                  ->orWhere('nama', 'like', '%' . $search . '%');
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
            'kode' => 'required|string|unique:qhs_kategori,kode',
            'nama' => 'required|string',
            'aktif' => 'required|string'
        ]);

        $data = QHSKategori::create($validation);

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = QHSKategori::where('kode', $id)->firstOrFail();

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = QHSKategori::where('kode', $id)->firstOrFail();

        $validation = $request->validate([
            'nama' => 'sometimes|required|string',
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
        $data = QHSKategori::where('kode', $id)->firstOrFail();
        $data->delete();

        return response()->json([
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}
