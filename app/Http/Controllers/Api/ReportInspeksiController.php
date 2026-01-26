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
        $page = (int) $request->get('page', 1);
        $perPage = (int) $request->get('per_page', 5);

        $baseQuery = QHSInspectD::with(['inspectH.departemen'])
            ->whereIn('kode', ['001', '002']);

        if ($departemen) {
            $baseQuery->whereHas(
                'inspectH',
                fn($q) =>
                $q->where('kode_dept', $departemen)
            );
        }

        if ($bulan) {
            [$tahun, $bulanAngka] = explode('-', $bulan);
            $baseQuery->whereHas(
                'inspectH',
                fn($q) =>
                $q->whereYear('tanggal', $tahun)
                    ->whereMonth('tanggal', $bulanAngka)
            );
        }

        $allData = $baseQuery->get();

        $filteredQuery = clone $baseQuery;

        if ($status === 'Open') {
            $filteredQuery->whereNull('tgl_close');
        } elseif ($status === 'Closed') {
            $filteredQuery->whereNotNull('tgl_close');
        }

        $filteredData = $filteredQuery->get();

        $groupAll = $allData->groupBy(
            fn($item) => $item->inspectH->tanggal . '|' . $item->inspectH->kode_dept
        );

        $groupFiltered = $filteredData->groupBy(
            fn($item) => $item->inspectH->tanggal . '|' . $item->inspectH->kode_dept
        );

        $response = [
            'K3' => [],
            'Mutu' => [],
        ];

        foreach ($groupAll as $key => $itemsAll) {

            $itemsFiltered = $groupFiltered->get($key, collect());

            $inspectH = $itemsAll->first()->inspectH;
            $tanggal = $inspectH->tanggal;
            $deptName = $inspectH->departemen->nama_dept ?? '-';

            $totalAll = $itemsAll->count();
            $closedAll = $itemsAll->whereNotNull('tgl_close')->count();

            $percentAll = $totalAll > 0
                ? round(($closedAll / $totalAll) * 100, 2)
                : 0;

            foreach (['001' => 'K3', '002' => 'Mutu'] as $kode => $label) {

                $allPerKategori = $itemsAll->where('kode', $kode);
                $filteredPerKategori = $itemsFiltered->where('kode', $kode);

                if ($allPerKategori->isEmpty()) {
                    continue;
                }

                $totalFiltered = $filteredPerKategori->count();
                $closed = $filteredPerKategori->whereNotNull('tgl_close')->count();
                $open = $totalFiltered - $closed;

                $percentKategori = $allPerKategori->count() > 0
                    ? round(
                        ($allPerKategori->whereNotNull('tgl_close')->count()
                            / $allPerKategori->count()) * 100,
                        2
                    )
                    : 0;

                $tglPerbaikan = $allPerKategori
                    ->pluck('tgl_perbaikan')
                    ->filter()
                    ->sortDesc()
                    ->first();

                $response[$label][] = [
                    'tgl_inspeksi' => $tanggal,
                    'departemen' => $deptName,
                    'total_issue' => $totalFiltered,
                    'open_issue' => $open,
                    'closed_issue' => $closed,
                    'persentase_per_kategori' => $percentKategori,
                    'tgl_perbaikan' => $tglPerbaikan,
                    'persentase_semua_kategori' => $percentAll,
                ];
            }
        }

        $paginate = fn($items) => array_slice(
            $items,
            ($page - 1) * $perPage,
            $perPage
        );

        return response()->json([
            'success' => true,
            'kategori' => [
                'K3' => $paginate($response['K3']),
                'Mutu' => $paginate($response['Mutu']),
            ],
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => [
                    'K3' => count($response['K3']),
                    'Mutu' => count($response['Mutu']),
                ],
                'last_page' => [
                    'K3' => ceil(count($response['K3']) / $perPage),
                    'Mutu' => ceil(count($response['Mutu']) / $perPage),
                ],
            ],
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
