<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSInspectH;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiInspeksiMobileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request->get('per_page', 5);
        $page = $request->get('page', 1);
        $search = $request->get('search', '');

        $query = QHSInspectH::with(['inspectR', 'inspectD'])->orderBy('created_at', 'desc');

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('no_dokumen', 'like', '%' . $search . '%');
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
        $user = $request->user();

        $validation = $request->validate([
            'no_dokumen' => 'required|string|unique:qhs_inspect_h,no_dokumen',
            'jam_mulai' => 'required|string',
            'no_induk' => 'required|string|exists:qhs_inspector,no_induk',
            'kode_dept' => 'required|string|exists:qhs_departemen,kode_dept',
            'kode_lokasi' => 'nullable|string|exists:qhs_lokasi,kode_lokasi',
            'bukti_temuan' => 'required|string',
            'deskripsi' => 'required|string',
        ]);

        $inspectH = DB::transaction(function () use ($validation, $user) {
            $inspectH = QHSInspectH::create([
                'no_dokumen' => $validation['no_dokumen'],
                'tanggal' => now(),
                'jam_mulai' => $validation['jam_mulai'],
                'jam_selesai' => null,
                'kode_dept' => $validation['kode_dept'],
                'kode_lokasi' => $validation['kode_lokasi'],
                'user_input' => $user->no_induk
            ]);

            $inspectH->inspectR()->create([
                'no_induk' => $validation['no_induk']
            ]);

            $inspectH->inspectD()->createMany([
                [
                    'sub' => 1,
                    'kode' => '001',
                    'bukti_temuan' => $validation['bukti_temuan'],
                    'deskripsi' => $validation['deskripsi'],
                ],
                [
                    'sub' => 2,
                    'kode' => '002',
                    'bukti_temuan' => $validation['bukti_temuan'],
                    'deskripsi' => $validation['deskripsi'],
                ]
            ]);

            return $inspectH;
        });

        $inspectH->load(['inspectR', 'inspectD']);

        return $inspectH;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = QHSInspectH::with(['inspectR', 'inspectD'])->where('no_dokumen', $id)->firstOrFail();

        return $data;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validation = $request->validate([
            'jam_mulai' => 'sometimes|string',
            'no_induk' => 'sometimes|string|exists:qhs_inspector,no_induk',
            'kode_dept' => 'sometimes|string|exists:qhs_departemen,kode_dept',
            'kode_lokasi' => 'sometimes|nullable|string|exists:qhs_lokasi,kode_lokasi',
            'bukti_temuan' => 'sometimes|string',
            'deskripsi' => 'sometimes|string',
        ]);

        $inspectH = DB::transaction(function () use ($id, $validation, $request) {
            $inspectH = QHSInspectH::where('no_dokumen', $id)->firstOrFail();

            $inspectH_updates = [];

            if ($request->has('jam_mulai')) {
                $inspectH_updates['jam_mulai'] = $validation['jam_mulai'];
            }

            if ($request->has('kode_dept')) {
                $inspectH_updates['kode_dept'] = $validation['kode_dept'];
            }

            if ($request->exists('kode_lokasi')) {
                $inspectH_updates['kode_lokasi'] = $validation['kode_lokasi'];
            }

            if (!empty($inspectH_updates)) {
                $inspectH->update($inspectH_updates);
            }

            if ($request->has('no_induk')) {
                $inspectH->inspectR()->update([
                    'no_induk' => $validation['no_induk']
                ]);
            }

            $inspectD_updates = [];

            if ($request->has('bukti_temuan')) {
                $inspectD_updates['bukti_temuan'] = $validation['bukti_temuan'];
            }

            if ($request->has('deskripsi')) {
                $inspectD_updates['deskripsi'] = $validation['deskripsi'];
            }

            if (!empty($inspectD_updates)) {
                $inspectH->inspectD()
                    ->whereIn('sub', [1, 2])
                    ->update($inspectD_updates);
            }

            return $inspectH;
        });

        $inspectH->load(['inspectR', 'inspectD']);

        return $inspectH;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $inspectH = QHSInspectH::where('no_dokumen', $id)->firstOrFail();
        $inspectH->delete();

        return response()->json([
            'message' => 'Data inspeksi berhasil dihapus'
        ], 200);
    }
}
