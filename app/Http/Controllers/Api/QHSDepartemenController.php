<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSDepartemen;
use Illuminate\Http\Request;

class QHSDepartemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $page = $request->get('page', 1);
        $search = $request->get('search', '');

        $query = QHSDepartemen::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('kode_dept', 'like', '%' . $search . '%')
                  ->orWhere('nama_dept', 'like', '%' . $search . '%');
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
            'kode_dept' => 'required|string|unique:qhs_departemen,kode_dept',
            'nama_dept' => 'required|string',
            'aktif' => 'required|string'
        ]);

        $data = QHSDepartemen::create($validation);

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = QHSDepartemen::where('kode_dept', $id)->firstOrFail();

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = QHSDepartemen::where('kode_dept', $id)->firstOrFail();

        $validation = $request->validate([
            'nama_dept' => 'sometimes|required|string',
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
        $data = QHSDepartemen::where('kode_dept', $id)->firstOrFail();
        $data->delete();

        return response()->json([
            'message' => 'Departemen berhasil dihapus'
        ]);
    }
}
