<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSInspector;
use Illuminate\Http\Request;

class QHSInspectorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $page = $request->get('per_page', 5);

        $data = QHSInspector::paginate($page);

        return $data;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validation = $request->validate([
            'no_induk' => 'required|string|unique:qhs_inspector,no_induk',
            'nama' => 'required|string',
            'aktif' => 'required|string'
        ]);

        $data = QHSInspector::create($validation);

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = QHSInspector::findOrFail($id);

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = QHSInspector::findOrFail($id);

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
        $data = QHSInspector::findOrFail($id);
        $data->delete();

        return response()->json([
            'message' => 'Inspector berhasil dihapus'
        ]);
    }
}
