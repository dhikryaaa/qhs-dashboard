<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSDepartemen;
use App\Models\QHSRole;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $page = $request->get('page', 1);
        $search = $request->get('search', '');

        $query = User::query();

        // Apply search filter
        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('no_induk', 'like', '%' . $search . '%')
                  ->orWhere('nama', 'like', '%' . $search . '%')
                  ->orWhere('kode_role', 'like', '%' . $search . '%')
                  ->orWhere('kode_dept', 'like', '%' . $search . '%');
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
        $role = $request->get('kode_role');
        QHSRole::findOrFail($role);

        $dept = $request->get('kode_dept');
        QHSDepartemen::findOrFail($dept);

        $validation = $request->validate([
            'no_induk' => 'required|string|unique:users,no_induk',
            'nama' => 'required|string',
            'aktif' => 'required|string',
            'kode_role' => 'required|string',
            'kode_dept' => 'required|string',
            'password' => 'required|string'
        ]);

        $data = User::create($validation);

        return $data;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = User::where('no_induk', $id)->firstOrFail();

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::where('no_induk', $id)->firstOrFail();

        if ($request->has('kode_role') && $request->get('kode_role')) {
            QHSRole::findOrFail($request->get('kode_role'));
        }

        if ($request->has('kode_dept') && $request->get('kode_dept')) {
            QHSDepartemen::findOrFail($request->get('kode_dept'));
        }

        $validation = $request->validate([
            'nama' => 'sometimes|required|string',
            'aktif' => 'sometimes|required|string',
            'kode_role' => 'sometimes|nullable|string',
            'kode_dept' => 'sometimes|nullable|string',
            'password' => 'sometimes|required|string'
        ]);

        $data->update($validation);

        return $data;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::where('no_induk', $id)->firstOrFail();
        $data->delete();

        return response()->json([
            'message' => 'User berhasil dihapus'
        ]);
    }
}
