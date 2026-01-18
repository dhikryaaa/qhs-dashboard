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
        $page = $request->get('per_page', 5);

        $data = QHSDepartemen::paginate($page);

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
        $data = QHSDepartemen::findOrFail($id);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = QHSDepartemen::findOrFail($id);

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
        $data = QHSDepartemen::findOrFail($id);
        $data->delete();

        return response()->json([
            'message' => 'Departemen berhasil dihapus'
        ]);
    }
}
