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
        $kategori = $request->get('kategori'); 
        $perPage = $request->get('per_page', 5);

        $query = QHSInspectD::whereIn('kode', ['001', '002'])
            ->whereIn('sub', [1, 2])
            ->with(['inspectH']);

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

        if ($kategori) {
            $query->where('kode', $kategori);
        }

        $paginator = $query
            ->paginate($perPage)
            ->withQueryString();

        $data = collect($paginator->items());

        $groupByTanggal = $data->groupBy(
            fn($item) =>
            $item->inspectH->tanggal
        );

        $response = [
            'K3' => [],
            'Mutu' => [],
            'Total' => [],
        ];

        foreach ($groupByTanggal as $tanggal => $itemsPerTanggal) {
            $totalAll = $itemsPerTanggal->count();
            $closedAll = $itemsPerTanggal->whereNotNull('tgl_close')->count();
            $persenAll = $totalAll > 0
                ? round(($closedAll / $totalAll) * 100, 2)
                : 0;

            $perKategori = $itemsPerTanggal->groupBy('kode');

            foreach ($perKategori as $kode => $items) {
                if ($kategori && $kode !== $kategori) {
                    continue;
                }

                $total = $items->count();
                $closed = $items->whereNotNull('tgl_close')->count();
                $open = $total - $closed;
                $persenKategori = $total > 0
                    ? round(($closed / $total) * 100, 2)
                    : 0;

                $tglPerbaikan = $items
                    ->pluck('tgl_perbaikan')
                    ->filter()
                    ->sortDesc()
                    ->first();

                $label = $kode === '001' ? 'K3' : 'Mutu';

                $response[$label][] = [
                    'tgl_inspeksi' => $tanggal,
                    'total_issue' => $total,
                    'open' => $open,
                    'closed' => $closed,
                    'persentase_kategori' => $persenKategori,
                    'tgl_perbaikan' => $tglPerbaikan,
                    'persentase_semua_kategori' => $persenAll,
                ];
            }

            $response['Total'][] = [
                'tgl_inspeksi' => $tanggal,
                'total_issue' => $totalAll,
                'open' => $totalAll - $closedAll,
                'closed' => $closedAll,
                'persentase_semua_kategori' => $persenAll,
            ];
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
