<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSInspectD;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ExportReportAsExcelController extends Controller
{
    public function export(Request $request)
    {
        $departemen = $request->get('departemen');
        $bulan = $request->get('bulan');
        $status = $request->get('status');

        // Get data dengan logic yang sama seperti ReportInspeksiController
        $data = $this->getData($departemen, $bulan, $status);

        $spreadsheet = IOFactory::load(
            resource_path('excel/template_report_inspeksi.xlsx')
        );

        $sheet = $spreadsheet->getActiveSheet();

        // === ISI HEADER ===
        if ($bulan) {
            [$tahun, $bulanAngka] = explode('-', $bulan);
            $monthName = \DateTime::createFromFormat('!m', $bulanAngka)->format('F');
            $sheet->setCellValue('M3', ": {$monthName} {$tahun}");
        } else {
            $sheet->setCellValue('M3', ': ' . now()->format('F Y'));
        }

        // === ISI TABLE (START ROW 6) ===
        $row = 6;
        $no = 1;

        // Process K3 data
        foreach ($data['K3']['items'] as $item) {
            $sheet->setCellValue("A{$row}", $no++);
            $sheet->setCellValue("B{$row}", \Carbon\Carbon::parse($item['tgl_inspeksi'])->format('d/m/Y'));
            $sheet->setCellValue("C{$row}", $item['departemen']);

            // K3 columns
            $sheet->setCellValue("D{$row}", $item['total_issue']);
            $sheet->setCellValue("E{$row}", $item['open_issue']);
            $sheet->setCellValue("F{$row}", $item['closed_issue']);
            $sheet->setCellValue("G{$row}", $item['persentase_per_kategori'] . '%');

            // Mutu (empty for K3 rows)
            $sheet->setCellValue("H{$row}", '');
            $sheet->setCellValue("I{$row}", '');
            $sheet->setCellValue("J{$row}", '');
            $sheet->setCellValue("K{$row}", '');

            // Footer columns
            $sheet->setCellValue("L{$row}", $item['tgl_perbaikan'] ? \Carbon\Carbon::parse($item['tgl_perbaikan'])->format('d/m/Y') : '');
            $sheet->setCellValue("M{$row}", $item['persentase_semua_kategori'] . '%');

            $row++;
        }

        // Add empty row between K3 and Mutu
        $row++;

        // Process Mutu data
        foreach ($data['Mutu']['items'] as $item) {
            $sheet->setCellValue("A{$row}", $no++);
            $sheet->setCellValue("B{$row}", \Carbon\Carbon::parse($item['tgl_inspeksi'])->format('d/m/Y'));
            $sheet->setCellValue("C{$row}", $item['departemen']);

            // K3 (empty for Mutu rows)
            $sheet->setCellValue("D{$row}", '');
            $sheet->setCellValue("E{$row}", '');
            $sheet->setCellValue("F{$row}", '');
            $sheet->setCellValue("G{$row}", '');

            // Mutu columns
            $sheet->setCellValue("H{$row}", $item['total_issue']);
            $sheet->setCellValue("I{$row}", $item['open_issue']);
            $sheet->setCellValue("J{$row}", $item['closed_issue']);
            $sheet->setCellValue("K{$row}", $item['persentase_per_kategori'] . '%');

            // Footer columns
            $sheet->setCellValue("L{$row}", $item['tgl_perbaikan'] ? \Carbon\Carbon::parse($item['tgl_perbaikan'])->format('d/m/Y') : '');
            $sheet->setCellValue("M{$row}", $item['persentase_semua_kategori'] . '%');

            $row++;
        }

        // === TOTAL SUMMARY ===
        // K3 Summary
        $k3Summary = $data['K3']['summary'];
        $sheet->setCellValue('D12', $k3Summary['total_temuan']);
        $sheet->setCellValue('E12', $k3Summary['total_open']);
        $sheet->setCellValue('F12', $k3Summary['total_closed']);
        $sheet->setCellValue('G12', $k3Summary['persentase'] . '%');

        // Mutu Summary
        $mutuSummary = $data['Mutu']['summary'];
        $sheet->setCellValue('H12', $mutuSummary['total_temuan']);
        $sheet->setCellValue('I12', $mutuSummary['total_open']);
        $sheet->setCellValue('J12', $mutuSummary['total_closed']);
        $sheet->setCellValue('K12', $mutuSummary['persentase'] . '%');

        // === TTD ===
        $sheet->setCellValue('L14', 'Surabaya, ' . now()->format('d F Y'));

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $filename = 'rekap-inspeksi-' . now()->format('Y-m-d-His') . '.xlsx';
        $tempPath = storage_path("app/{$filename}");

        $writer->save($tempPath);

        return response()->download($tempPath)->deleteFileAfterSend();
    }

    private function getData($departemen = null, $bulan = null, $status = null)
    {
        $baseQuery = QHSInspectD::with(['inspectH.departemen'])
            ->whereIn('kode', ['001', '002']);

        if ($departemen) {
            $baseQuery->whereHas(
                'inspectH',
                fn($q) => $q->where('kode_dept', $departemen)
            );
        }

        if ($bulan) {
            [$tahun, $bulanAngka] = explode('-', $bulan);
            $baseQuery->whereHas(
                'inspectH',
                fn($q) => $q->whereYear('tanggal', $tahun)
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

        $k3Items = [];
        $mutuItems = [];

        foreach ($groupAll as $key => $itemsAll) {
            $itemsFiltered = $groupFiltered->get($key, collect());
            $inspectH = $itemsAll->first()->inspectH;
            $tanggal = $inspectH->tanggal;
            $deptName = $inspectH->departemen->nama_dept ?? '-';

            $totalAll = $itemsAll->count();
            $closedAll = $itemsAll->whereNotNull('tgl_close')->count();
            $percentAll = $totalAll > 0 ? round(($closedAll / $totalAll) * 100, 2) : 0;

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

                $itemData = [
                    'tgl_inspeksi' => $tanggal,
                    'departemen' => $deptName,
                    'total_issue' => $totalFiltered,
                    'open_issue' => $open,
                    'closed_issue' => $closed,
                    'persentase_per_kategori' => $percentKategori,
                    'tgl_perbaikan' => $tglPerbaikan,
                    'persentase_semua_kategori' => $percentAll,
                ];

                if ($label === 'K3') {
                    $k3Items[] = $itemData;
                } else {
                    $mutuItems[] = $itemData;
                }
            }
        }

        // Calculate summaries
        $k3Summary = $this->calculateSummary($allData, $filteredData, '001');
        $mutuSummary = $this->calculateSummary($allData, $filteredData, '002');

        return [
            'K3' => [
                'items' => $k3Items,
                'summary' => $k3Summary,
            ],
            'Mutu' => [
                'items' => $mutuItems,
                'summary' => $mutuSummary,
            ],
        ];
    }

    private function calculateSummary($allData, $filteredData, $kode)
    {
        $filteredPerKategori = $filteredData->where('kode', $kode);
        $allPerKategori = $allData->where('kode', $kode);

        $total = $filteredPerKategori->count();
        $closed = $filteredPerKategori->whereNotNull('tgl_close')->count();
        $open = $total - $closed;

        $allTotal = $allPerKategori->count();
        $allClosed = $allPerKategori->whereNotNull('tgl_close')->count();

        $persentase = $allTotal > 0
            ? round(($allClosed / $allTotal) * 100, 2)
            : 0;

        return [
            'total_temuan' => $total,
            'total_open' => $open,
            'total_closed' => $closed,
            'persentase' => $persentase,
        ];
    }
}
