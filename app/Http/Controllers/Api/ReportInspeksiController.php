<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSInspectD;
use Illuminate\Http\Request;

class ReportInspeksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $departemen = $request->get('departemen');
        $bulan = $request->get('bulan');
        $status = $request->get('status');
        $page = $request->get('per_page', 5);

        $query = QHSInspectD::with(['inspectH.departemen'])
            ->whereIn('kode', ['001', '002']);

        if ($departemen) {
            $query->whereHas('inspectH', function ($q) use ($departemen) {
                $q->where('kode_dept', $departemen);
            });
        }

        if ($bulan) {
            [$tahun, $bulanAngka] = explode('-', $bulan);
            $query->whereHas('inspectH', function ($q) use ($tahun, $bulanAngka) {
                $q->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulanAngka);
            });
        }

        if ($status === 'open') {
            $query->whereNull('tgl_close');
        } elseif ($status === 'closed') {
            $query->whereNotNull('tgl_close');
        }

        $paginator = $query->paginate($page);
        $paginator->appends($request->query());

        $data = collect($paginator->items());

        $grouped = $data->groupBy(
            fn($item) =>
            $item->inspectH->tanggal . '|' . $item->inspectH->kode_dept
        );

        $response = [
            'K3' => [],
            'Mutu' => [],
        ];

        foreach ($grouped as $groupKey => $items) {

            $inspectH = $items->first()->inspectH;
            $tanggal = $inspectH->tanggal;
            $deptName = $inspectH->departemen->nama_dept ?? '-';

            $totalAll = $items->count();
            $closedAll = $items->whereNotNull('tgl_close')->count();
            $percentAll = $totalAll > 0
                ? round(($closedAll / $totalAll) * 100, 2)
                : 0;

            foreach (['001' => 'K3', '002' => 'Mutu'] as $kode => $label) {

                $perKategori = $items->where('kode', $kode);

                if ($perKategori->isEmpty()) {
                    continue;
                }

                $total = $perKategori->count();
                $closed = $perKategori->whereNotNull('tgl_close')->count();
                $open = $total - $closed;

                $percentKategori = $total > 0
                    ? round(($closed / $total) * 100, 2)
                    : 0;

                $tglPerbaikan = $perKategori
                    ->pluck('tgl_perbaikan')
                    ->filter()
                    ->sortDesc()
                    ->first();

                $response[$label][] = [
                    'tgl_inspeksi' => $tanggal,
                    'departemen' => $deptName,
                    'total_issue' => $total,
                    'open_issue' => $open,
                    'closed_issue' => $closed,
                    'persentase_per_kategori' => $percentKategori,
                    'tgl_perbaikan' => $tglPerbaikan,
                    'persentase_semua_kategori' => $percentAll,
                ];
            }
        }

        return response()->json([
            'success' => true,
            'kategori' => $response,
            'pagination' => [
                'current_page' => $paginator->currentPage(),
                'per_page' => $paginator->perPage(),
                'total' => $paginator->total(),
                'last_page' => $paginator->lastPage(),
            ]
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
