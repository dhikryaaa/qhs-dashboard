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
            'Mutu' => [],
            'K3' => [],
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

            foreach (['001' => 'Mutu', '002' => 'K3'] as $kode => $label) {

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

        $summary = [
            'Mutu' => [
                'total_temuan' => 0,
                'total_open' => 0,
                'total_closed' => 0,
                'persentase' => 0,
            ],
            'K3' => [
                'total_temuan' => 0,
                'total_open' => 0,
                'total_closed' => 0,
                'persentase' => 0,
            ],
        ];

        foreach (['001' => 'Mutu', '002' => 'K3'] as $kode => $label) {

            // ===== DATA FILTERED (jumlah mengikuti filter status)
            $filteredPerKategori = $filteredData->where('kode', $kode);

            $total = $filteredPerKategori->count();
            $closed = $filteredPerKategori->whereNotNull('tgl_close')->count();
            $open = $total - $closed;

            // ===== DATA ALL (untuk persentase)
            $allPerKategori = $allData->where('kode', $kode);
            $allTotal = $allPerKategori->count();
            $allClosed = $allPerKategori->whereNotNull('tgl_close')->count();

            $persentase = $allTotal > 0
                ? round(($allClosed / $allTotal) * 100, 2)
                : 0;

            $summary[$label] = [
                'total_temuan' => $total,
                'total_open' => $open,
                'total_closed' => $closed,
                'persentase' => $persentase,
            ];
        }

        return response()->json([
            'success' => true,
            'kategori' => [
                'Mutu' => $paginate($response['Mutu']),
                'Total_Mutu' => $summary['Mutu'],

                'K3' => $paginate($response['K3']),
                'Total_K3' => $summary['K3'],
            ],
            'pagination' => [
                'current_page' => $page,
                'per_page' => $perPage,
                'total' => [
                    'Mutu' => count($response['Mutu']),
                    'K3' => count($response['K3']),
                ],
                'last_page' => [
                    'Mutu' => ceil(count($response['Mutu']) / $perPage),
                    'K3' => ceil(count($response['K3']) / $perPage),
                ],
            ],
        ]);
    }
}
