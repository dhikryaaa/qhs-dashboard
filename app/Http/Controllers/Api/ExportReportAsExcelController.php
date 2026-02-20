<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\QHSInspectD;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;

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
            $monthName = Carbon::createFromDate($tahun, $bulanAngka, 1)->locale('id')->translatedFormat('F');
            $sheet->setCellValue('M3', ": {$monthName} {$tahun}");
        } else {
            $sheet->setCellValue('M3', ': ' . now()->locale('id')->translatedFormat('F Y'));
        }

        // === ISI TABLE (START ROW 6) ===
        $row = 6;
        $no = 1;

        // Group data by departemen and date
        $groupedData = [];
        foreach ($data['K3']['items'] as $item) {
            $key = $item['tgl_inspeksi'] . '|' . $item['departemen'];
            if (!isset($groupedData[$key])) {
                $groupedData[$key] = [
                    'tgl_inspeksi' => $item['tgl_inspeksi'],
                    'departemen' => $item['departemen'],
                    'K3' => null,
                    'Mutu' => null,
                ];
            }
            $groupedData[$key]['K3'] = $item;
        }

        foreach ($data['Mutu']['items'] as $item) {
            $key = $item['tgl_inspeksi'] . '|' . $item['departemen'];
            if (!isset($groupedData[$key])) {
                $groupedData[$key] = [
                    'tgl_inspeksi' => $item['tgl_inspeksi'],
                    'departemen' => $item['departemen'],
                    'K3' => null,
                    'Mutu' => null,
                ];
            }
            $groupedData[$key]['Mutu'] = $item;
        }

        // Display grouped data by department
        foreach ($groupedData as $group) {
            $sheet->setCellValue("A{$row}", $no++);
            
            // Tanggal Inspeksi - Center
            $sheet->setCellValue("B{$row}", Carbon::parse($group['tgl_inspeksi'])->format('d/m/Y'));
            $sheet->getStyle("B{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            
            // Departemen - Left
            $sheet->setCellValue("C{$row}", $group['departemen']);
            $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);

            // Mutu columns - Center
            if ($group['Mutu']) {
                $sheet->setCellValue("D{$row}", $group['Mutu']['total_issue']);
                $sheet->getStyle("D{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $sheet->setCellValue("E{$row}", $group['Mutu']['open_issue']);
                $sheet->getStyle("E{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $sheet->setCellValue("F{$row}", $group['Mutu']['closed_issue']);
                $sheet->getStyle("F{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $sheet->setCellValue("G{$row}", $group['Mutu']['persentase_per_kategori'] . '%');
                $sheet->getStyle("G{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // Tanggal Perbaikan - Center (from Mutu)
                $sheet->setCellValue("L{$row}", $group['Mutu']['tgl_perbaikan'] ? Carbon::parse($group['Mutu']['tgl_perbaikan'])->format('d/m/Y') : '');
                $sheet->getStyle("L{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                // % perbaikan keseluruhan - Center (from Mutu)
                $sheet->setCellValue("M{$row}", $group['Mutu']['persentase_semua_kategori'] . '%');
                $sheet->getStyle("M{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }

            // K3 columns - Center
            if ($group['K3']) {
                $sheet->setCellValue("H{$row}", $group['K3']['total_issue']);
                $sheet->getStyle("H{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $sheet->setCellValue("I{$row}", $group['K3']['open_issue']);
                $sheet->getStyle("I{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $sheet->setCellValue("J{$row}", $group['K3']['closed_issue']);
                $sheet->getStyle("J{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $sheet->setCellValue("K{$row}", $group['K3']['persentase_per_kategori'] . '%');
                $sheet->getStyle("K{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }
            
            if (!$group['Mutu']) {
                // If only K3 exists, use K3 data for L and M columns
                $sheet->setCellValue("L{$row}", $group['K3']['tgl_perbaikan'] ? Carbon::parse($group['K3']['tgl_perbaikan'])->format('d/m/Y') : '');
                $sheet->getStyle("L{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
                
                $sheet->setCellValue("M{$row}", $group['K3']['persentase_semua_kategori'] . '%');
                $sheet->getStyle("M{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
            }

            $row++;
        }

        $sheet->getStyle("A6:M" . ($row - 1))->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle("M6:M" . ($row - 1))->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);

        // Add empty row as separator
        $row++;
        $summaryStartRow = $row;

        // === TOTAL SUMMARY ===
        // K3 Summary
        $k3Summary = $data['K3']['summary'];
        $k3EndRow = $row + 2;
        
        // Total temuan K3
        $sheet->setCellValue("A{$row}", "Total temuan K3");
        $sheet->setCellValue("C{$row}", ": " . $k3Summary['total_temuan']);
        $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $row++;
        
        // Temuan Closed K3
        $sheet->setCellValue("A{$row}", "Temuan Closed");
        $sheet->setCellValue("C{$row}", ": " . $k3Summary['total_closed']);
        $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $row++;
        
        // Temuan Open K3
        $sheet->setCellValue("A{$row}", "Temuan Open");
        $sheet->setCellValue("C{$row}", ": " . $k3Summary['total_open']);
        $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        
        // Merge D column for K3 percentage
        $sheet->mergeCells("D{$summaryStartRow}:D{$row}");
        $sheet->setCellValue("D{$summaryStartRow}", $k3Summary['persentase'] . '%');
        $sheet->getStyle("D{$summaryStartRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("D{$summaryStartRow}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle("D{$summaryStartRow}")->getFont()->setBold(true);
        $sheet->getStyle("D{$summaryStartRow}")->getFont()->setSize(12);
        
        // Add borders to K3 summary
        $this->addSummaryBorders($sheet, $summaryStartRow, $row);
        
        $row++;
        
        // Add empty row
        $row++;
        
        // Mutu Summary
        $mutuSummary = $data['Mutu']['summary'];
        $mutuStartRow = $row;
        $mutuEndRow = $row + 2;
        
        // Total temuan Mutu
        $sheet->setCellValue("A{$row}", "Total temuan Mutu");
        $sheet->setCellValue("C{$row}", ": " . $mutuSummary['total_temuan']);
        $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $row++;
        
        // Temuan Closed Mutu
        $sheet->setCellValue("A{$row}", "Temuan Closed");
        $sheet->setCellValue("C{$row}", ": " . $mutuSummary['total_closed']);
        $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $row++;
        
        // Temuan Open Mutu
        $sheet->setCellValue("A{$row}", "Temuan Open");
        $sheet->setCellValue("C{$row}", ": " . $mutuSummary['total_open']);
        $sheet->getStyle("A{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        $sheet->getStyle("C{$row}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        
        // Merge D column for Mutu percentage
        $sheet->mergeCells("D{$mutuStartRow}:D{$row}");
        $sheet->setCellValue("D{$mutuStartRow}", $mutuSummary['persentase'] . '%');
        $sheet->getStyle("D{$mutuStartRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("D{$mutuStartRow}")->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle("D{$mutuStartRow}")->getFont()->setBold(true);
        $sheet->getStyle("D{$mutuStartRow}")->getFont()->setSize(12);
        
        // Add borders to Mutu summary
        $this->addSummaryBorders($sheet, $mutuStartRow, $row);
        
        $row++;

        // === TTD ===
        $ttdRow = $summaryStartRow;
        $sheet->mergeCells("L{$ttdRow}:M{$ttdRow}");
        $sheet->setCellValue("L{$ttdRow}", 'Surabaya, ' . now()->locale('id')->translatedFormat('d F Y'));
        $sheet->getStyle("L{$ttdRow}")->getFont()->setSize(10);
        $sheet->getStyle("L{$ttdRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

        // TTD Header Row
        $ttdStartRow = $ttdRow + 2;
        $sheet->setCellValue("L{$ttdStartRow}", "Disetujui");
        $sheet->setCellValue("M{$ttdStartRow}", "Dibuat & Diperiksa");
        $sheet->getStyle("L{$ttdStartRow}")->getFont()->setSize(8);
        $sheet->getStyle("M{$ttdStartRow}")->getFont()->setSize(8);
        $sheet->getStyle("L{$ttdStartRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("M{$ttdStartRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("L{$ttdStartRow}:M{$ttdStartRow}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        // TTD Names and Positions
        $ttdNameRow = $ttdStartRow + 3;
        $sheet->setCellValue("L{$ttdNameRow}", "Yanata Candra");
        $sheet->setCellValue("M{$ttdNameRow}", "Javiero Isroj W");
        $sheet->getStyle("L{$ttdNameRow}")->getFont()->setSize(8);
        $sheet->getStyle("M{$ttdNameRow}")->getFont()->setSize(8);
        $sheet->getStyle("L{$ttdNameRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("M{$ttdNameRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("L{$ttdStartRow}:L" . $ttdStartRow + 4)->getBorders()->getLeft()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle("L{$ttdStartRow}:L" . $ttdStartRow + 4)->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);
        $sheet->getStyle("M{$ttdStartRow}:M" . $ttdStartRow + 4)->getBorders()->getRight()->setBorderStyle(Border::BORDER_THIN);
        
        $ttdPosRow = $ttdNameRow + 1;
        $sheet->setCellValue("L{$ttdPosRow}", "Ass Man QMS");
        $sheet->setCellValue("M{$ttdPosRow}", "QHS Assisten Officer");
        $sheet->getStyle("L{$ttdPosRow}")->getFont()->setSize(8);
        $sheet->getStyle("M{$ttdPosRow}")->getFont()->setSize(8);
        $sheet->getStyle("L{$ttdPosRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("M{$ttdPosRow}")->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        $sheet->getStyle("L{$ttdPosRow}:M{$ttdPosRow}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');

        $filename = 'Rekap-Inspeksi-' . $monthName . $tahun . '.xlsx';
        $tempPath = storage_path("app/{$filename}");

        $writer->save($tempPath);

        return response()->download($tempPath)->deleteFileAfterSend();
    }

    private function addSummaryBorders($sheet, $startRow, $endRow)
    {
        // Apply top and bottom borders to A-D columns
        for ($col = 'A'; $col <= 'D'; $col++) {
            $sheet->getStyle("{$col}{$startRow}")->getBorders()->getTop()->setBorderStyle(Border::BORDER_THIN);
            $sheet->getStyle("{$col}{$endRow}")->getBorders()->getBottom()->setBorderStyle(Border::BORDER_THIN);
        }

        // Apply border between C and D columns for all rows
        for ($i = $startRow; $i <= $endRow; $i++) {
            $sheet->getStyle("D{$i}")->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN);
        }
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
        $mutuSummary = $this->calculateSummary($allData, $filteredData, '001');
        $k3Summary = $this->calculateSummary($allData, $filteredData, '002');

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
