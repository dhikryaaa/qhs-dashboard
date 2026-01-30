@php
/**
 * ==========================================
 * DASHBOARD DATA PREPARATION
 * ==========================================
 * This section prepares all data for the QHS Dashboard including:
 * - Raw incident, CPAR, and inspection data
 * - Chart visualization data
 * - Table display data
 * - Statistical calculations and trends
 */

// ==========================================
// 1. RAW DATA FROM COMPANY
// ==========================================

/**
 * Incident data grouped by year
 * Structure: bulan, lalu_lintas, lingkungan_kerja, total
 */
$insidenData = [
    2024 => [
        ['bulan' => 1, 'lalu_lintas' => 2, 'lingkungan_kerja' => 2, 'total' => 4],
        ['bulan' => 2, 'lalu_lintas' => 2, 'lingkungan_kerja' => 3, 'total' => 5],
        ['bulan' => 3, 'lalu_lintas' => 1, 'lingkungan_kerja' => 0, 'total' => 1],
        ['bulan' => 4, 'lalu_lintas' => 1, 'lingkungan_kerja' => 2, 'total' => 3],
        ['bulan' => 5, 'lalu_lintas' => 1, 'lingkungan_kerja' => 2, 'total' => 3],
        ['bulan' => 6, 'lalu_lintas' => 1, 'lingkungan_kerja' => 1, 'total' => 2],
        ['bulan' => 7, 'lalu_lintas' => 3, 'lingkungan_kerja' => 1, 'total' => 4],
        ['bulan' => 8, 'lalu_lintas' => 2, 'lingkungan_kerja' => 2, 'total' => 4],
        ['bulan' => 9, 'lalu_lintas' => 1, 'lingkungan_kerja' => 3, 'total' => 4],
        ['bulan' => 10, 'lalu_lintas' => 2, 'lingkungan_kerja' => 1, 'total' => 3],
        ['bulan' => 11, 'lalu_lintas' => 1, 'lingkungan_kerja' => 2, 'total' => 3],
        ['bulan' => 12, 'lalu_lintas' => 1, 'lingkungan_kerja' => 1, 'total' => 2],
    ],
    2025 => [
        ['bulan' => 1, 'lalu_lintas' => 2, 'lingkungan_kerja' => 3, 'total' => 5],
        ['bulan' => 2, 'lalu_lintas' => 2, 'lingkungan_kerja' => 1, 'total' => 3],
        ['bulan' => 3, 'lalu_lintas' => 4, 'lingkungan_kerja' => 1, 'total' => 5],
        ['bulan' => 4, 'lalu_lintas' => 1, 'lingkungan_kerja' => 1, 'total' => 2],
        ['bulan' => 5, 'lalu_lintas' => 2, 'lingkungan_kerja' => 2, 'total' => 4],
        ['bulan' => 6, 'lalu_lintas' => 0, 'lingkungan_kerja' => 2, 'total' => 2],
        ['bulan' => 7, 'lalu_lintas' => 0, 'lingkungan_kerja' => 3, 'total' => 3],
        ['bulan' => 8, 'lalu_lintas' => 1, 'lingkungan_kerja' => 1, 'total' => 2],
        ['bulan' => 9, 'lalu_lintas' => 2, 'lingkungan_kerja' => 2, 'total' => 4],
        ['bulan' => 10, 'lalu_lintas' => 1, 'lingkungan_kerja' => 1, 'total' => 2],
    ],
];

/**
 * CPAR (Corrective & Preventive Action Request) data
 * Structure: tahun, audit, major, minor, observasi, total
 */
$cparData = [
    // 2023 Data
    ['tahun' => 2023, 'audit' => 'ISO-9001', 'major' => 0, 'minor' => 3, 'observasi' => 2, 'total' => 5],
    ['tahun' => 2023, 'audit' => 'ISO-45001', 'major' => 0, 'minor' => 4, 'observasi' => 1, 'total' => 5],
    ['tahun' => 2023, 'audit' => 'ISO-17025', 'major' => 0, 'minor' => 10, 'observasi' => 3, 'total' => 13],
    ['tahun' => 2023, 'audit' => 'SNI', 'major' => 0, 'minor' => 2, 'observasi' => 1, 'total' => 3],
    // 2024 Data
    ['tahun' => 2024, 'audit' => 'ISO-9001', 'major' => 0, 'minor' => 6, 'observasi' => 2, 'total' => 8],
    ['tahun' => 2024, 'audit' => 'ISO-45001', 'major' => 0, 'minor' => 4, 'observasi' => 3, 'total' => 7],
    ['tahun' => 2024, 'audit' => 'ISO-17025', 'major' => 0, 'minor' => 5, 'observasi' => 1, 'total' => 6],
    ['tahun' => 2024, 'audit' => 'SNI', 'major' => 0, 'minor' => 3, 'observasi' => 4, 'total' => 7],
    // 2025 Data
    ['tahun' => 2025, 'audit' => 'ISO-9001', 'major' => 0, 'minor' => 5, 'observasi' => 2, 'total' => 7],
    ['tahun' => 2025, 'audit' => 'ISO-45001', 'major' => 0, 'minor' => 2, 'observasi' => 1, 'total' => 3],
    ['tahun' => 2025, 'audit' => 'ISO-17025', 'major' => 0, 'minor' => 3, 'observasi' => 2, 'total' => 5],
    ['tahun' => 2025, 'audit' => 'SNI', 'major' => 0, 'minor' => 3, 'observasi' => 1, 'total' => 4],
];

/**
 * Inspection data grouped by year
 * Structure: bulan, mutu, k3, 5r, total
 */
$inspectionData = [
    2024 => [
        ['bulan' => 1, 'mutu' => 2, 'k3' => 2, '5r' => 2, 'total' => 6],
        ['bulan' => 2, 'mutu' => 2, 'k3' => 3, '5r' => 1, 'total' => 6],
        ['bulan' => 3, 'mutu' => 1, 'k3' => 0, '5r' => 1, 'total' => 2],
        ['bulan' => 4, 'mutu' => 1, 'k3' => 2, '5r' => 2, 'total' => 5],
        ['bulan' => 5, 'mutu' => 1, 'k3' => 2, '5r' => 1, 'total' => 4],
        ['bulan' => 6, 'mutu' => 1, 'k3' => 1, '5r' => 2, 'total' => 4],
        ['bulan' => 7, 'mutu' => 3, 'k3' => 1, '5r' => 3, 'total' => 7],
        ['bulan' => 8, 'mutu' => 2, 'k3' => 2, '5r' => 1, 'total' => 5],
        ['bulan' => 9, 'mutu' => 1, 'k3' => 3, '5r' => 1, 'total' => 5],
        ['bulan' => 10, 'mutu' => 2, 'k3' => 1, '5r' => 1, 'total' => 4],
        ['bulan' => 11, 'mutu' => 1, 'k3' => 2, '5r' => 2, 'total' => 5],
        ['bulan' => 12, 'mutu' => 1, 'k3' => 1, '5r' => 2, 'total' => 4],
    ],
    2025 => [
        ['bulan' => 1, 'mutu' => 2, 'k3' => 3, '5r' => 1, 'total' => 6],
        ['bulan' => 2, 'mutu' => 2, 'k3' => 1, '5r' => 2, 'total' => 5],
        ['bulan' => 3, 'mutu' => 4, 'k3' => 1, '5r' => 1, 'total' => 6],
        ['bulan' => 4, 'mutu' => 1, 'k3' => 1, '5r' => 3, 'total' => 5],
        ['bulan' => 5, 'mutu' => 2, 'k3' => 2, '5r' => 2, 'total' => 6],
        ['bulan' => 6, 'mutu' => 0, 'k3' => 2, '5r' => 2, 'total' => 4],
        ['bulan' => 7, 'mutu' => 0, 'k3' => 3, '5r' => 1, 'total' => 4],
        ['bulan' => 8, 'mutu' => 1, 'k3' => 1, '5r' => 1, 'total' => 3],
        ['bulan' => 9, 'mutu' => 2, 'k3' => 2, '5r' => 1, 'total' => 5],
        ['bulan' => 10, 'mutu' => 1, 'k3' => 1, '5r' => 3, 'total' => 5],
    ],
];

// ==========================================
// 2. HELPER FUNCTIONS (DRY PRINCIPLE)
// ==========================================

/**
 * Get department name based on rotation pattern
 * @param int $index - Month or index number
 * @return string Department name
 */
$getDepartment = function(int $index): string {
    $departments = ['Produksi', 'Umum', 'Logistik'];
    return $departments[$index % 3];
};

/**
 * Determine highest category from inspection data
 * @param array $row - Inspection data row
 * @return string Category name
 */
$getHighestCategory = function(array $row): string {
    $max = max($row['mutu'], $row['k3'], $row['5r']);
    if ($row['mutu'] === $max) return 'Mutu';
    if ($row['k3'] === $max) return 'K3';
    return '5R';
};

/**
 * Calculate year-over-year trend percentage
 * @param float $current - Current year value
 * @param float $previous - Previous year value
 * @return float Trend percentage
 */
$calculateTrend = function(float $current, float $previous): float {
    return $previous > 0 ? round((($current - $previous) / $previous) * 100, 1) : 0;
};

/**
 * Generate trend label based on percentage
 * @param float $trend - Trend percentage
 * @param string $baseText - Base text (default: "from 2024")
 * @return string Trend label
 */
$getTrendLabel = function(float $trend, string $baseText = 'from 2024'): string {
    if ($trend < 0) return "Down {$baseText}";
    if ($trend > 0) return "Up {$baseText}";
    return "No change";
};

// ==========================================
// 3. CHART DATA PREPARATION
// ==========================================

$chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'];
$chartKerja = array_column($insidenData[2025], 'lingkungan_kerja');
$chartLalin = array_column($insidenData[2025], 'lalu_lintas');

// Pie Chart: Document types distribution (using UBS brand colors)
$pieLabels = ['SOP', 'IK', 'OPL', 'BP', 'Formulir'];
$pieData = [150, 80, 45, 30, 210];
$pieColors = [
    '#f94144', // --ubs-red
    '#f3722c', // --ubs-red-orange
    '#f8961e', // --ubs-orange
    '#f9c74f', // --ubs-yellow
    '#90be6d'  // --ubs-green
];

// ==========================================
// 4. TABLE DATA TRANSFORMATION
// ==========================================

$monthNames = ['', 'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];

// Transform Insiden data for table display
$tableInsiden = array_map(function($row) use ($getDepartment) {
    return [
        'tanggal' => sprintf('%02d-01-2025', $row['bulan']),
        'nama' => 'Petugas ' . $row['bulan'],
        'dept' => $getDepartment($row['bulan']),
        'kategori' => $row['lalu_lintas'] > $row['lingkungan_kerja'] ? 'Lalu Lintas' : 'Kecelakaan Kerja',
        'deskripsi' => "Lalu Lintas: {$row['lalu_lintas']}, Lingkungan Kerja: {$row['lingkungan_kerja']}",
    ];
}, $insidenData[2025]);

// Transform CPAR data for table display
$cpar2025 = array_filter($cparData, fn($item) => $item['tahun'] === 2025);
$tableCPAR = [];
foreach ($cpar2025 as $idx => $row) {
    $kategori = $row['minor'] > 0 ? 'Minor' : ($row['major'] > 0 ? 'Major' : 'Observasi');
    $findingCount = $row[strtolower($kategori)] ?? $row['observasi'];
    
    $tableCPAR[] = [
        'audit' => $row['audit'],
        'deskripsi' => "Temuan {$kategori}: {$findingCount} item ditemukan",
        'kategori' => $kategori,
        'pic' => 'PIC ' . ($idx + 1),
        'status' => $idx % 2 === 0 ? 'Open' : 'Closed',
        'deadline' => sprintf('2025-%02d-15', ($idx + 1) * 3),
    ];
}

// Transform Inspection data for table display
$tableInspection = array_map(function($row) use ($monthNames, $getDepartment, $getHighestCategory) {
    return [
        'periode' => $monthNames[$row['bulan']] . ' 2025',
        'dept' => $getDepartment($row['bulan'] - 1),
        'deskripsi' => "Mutu: {$row['mutu']}, K3: {$row['k3']}, 5R: {$row['5r']}",
        'kategori' => $getHighestCategory($row),
        'status' => $row['bulan'] % 2 === 0 ? 'Closed' : 'Open',
        'deadline' => sprintf('2025-%02d-30', $row['bulan']),
    ];
}, $inspectionData[2025]);

// Permit data (static for now)
$tablePermit = [
    ['periode' => 'Jan 2025', 'dept' => 'Logistik', 'deskripsi' => 'Izin operasional forklift unit FL-001', 'kategori' => 'Alat Berat', 'status' => 'Active', 'deadline' => '20-10-2025'],
    ['periode' => 'Feb 2025', 'dept' => 'Umum', 'deskripsi' => 'Izin penggunaan genset cadangan', 'kategori' => 'Listrik', 'status' => 'Warning', 'deadline' => '15-02-2025'],
    ['periode' => 'Mar 2025', 'dept' => 'Produksi', 'deskripsi' => 'Izin operasi crane overhead 5 ton', 'kategori' => 'Alat Berat', 'status' => 'Active', 'deadline' => '30-12-2025'],
    ['periode' => 'Jan 2025', 'dept' => 'Umum', 'deskripsi' => 'Izin operasional boiler tekanan tinggi', 'kategori' => 'Pesawat Uap', 'status' => 'Expired', 'deadline' => '10-01-2025'],
];

// ==========================================
// 5. STATISTICAL CALCULATIONS
// ==========================================

// Incident Statistics
$totalInsiden2025 = array_sum(array_column($insidenData[2025], 'total'));
$totalInsiden2024 = array_sum(array_column($insidenData[2024], 'total'));
$insidenTrend = $calculateTrend($totalInsiden2025, $totalInsiden2024);

// CPAR Statistics
$cparByYear = fn($year) => array_filter($cparData, fn($item) => $item['tahun'] === $year);
$totalCPAR2025 = array_sum(array_column($cparByYear(2025), 'total'));
$totalCPAR2024 = array_sum(array_column($cparByYear(2024), 'total'));
$cparTrend = $calculateTrend($totalCPAR2025, $totalCPAR2024);

// Inspection Completion Rate
$closedInspections = fn($data) => count(array_filter($data, fn($item) => $item['status'] === 'Closed'));
$completionRate2025 = count($tableInspection) > 0 ? ($closedInspections($tableInspection) / count($tableInspection)) * 100 : 0;
$completionRate2024 = 50.0; // Calculated based on historical pattern (6 of 12 months closed)
$completionTrend = $calculateTrend($completionRate2025, $completionRate2024);

// Active Permits
$activePermits = count(array_filter($tablePermit, fn($item) => $item['status'] !== 'Expired'));
$previousActivePermits = 4;
$permitTrend = $calculateTrend($activePermits, $previousActivePermits);

// ==========================================
// 6. FINAL STATS ARRAY
// ==========================================

$stats = [
    'insiden' => [
        'total' => $totalInsiden2025,
        'trend' => $insidenTrend,
        'label' => $getTrendLabel($insidenTrend)
    ],
    'cpar' => [
        'total' => $totalCPAR2025,
        'trend' => $cparTrend,
        'label' => $getTrendLabel($cparTrend)
    ],
    'completion' => [
        'total' => round($completionRate2025, 1) . '%',
        'trend' => $completionTrend,
        'label' => $getTrendLabel($completionTrend)
    ],
    'permit' => [
        'total' => $activePermits,
        'trend' => $permitTrend,
        'label' => $getTrendLabel($permitTrend, 'from last period')
    ],
];
@endphp

@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
<style>
    /* Import UBS Brand Colors from CSS Variables */
    @import url('/css/variables.css');
    
    /* Import Google Fonts */
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Public+Sans:wght@400;500;600;700&family=Poppins:wght@400;600;700&display=swap');
    
    /* ========================================
       1. LAYOUT & STRUCTURE
       ======================================== */
    .dashboard-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        width: 100%;
        padding: 40px;
        background: var(--ubs-lighter-grey);
    }

    /* ========================================
       2. STATS CARDS - TOP ROW
       ======================================== */
    .stats-row {
        display: grid;
        gap: 20px;
        grid-template-columns: repeat(4, 1fr);
    }

    .stat-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 4px 4px -1px rgba(12, 12, 13, 0.1);
        display: flex;
        flex-direction: column;
        gap: 16px;
        padding: 20px;
    }

    .stat-header {
        align-items: center;
        display: flex;
        justify-content: space-between;
    }

    .stat-icon {
        align-items: center;
        background: rgba(32, 144, 224, 0.1);
        border-radius: 8px;
        display: flex;
        height: 48px;
        justify-content: center;
        width: 48px;
    }
    
    .stat-icon img {
        height: 28px;
        width: 28px;
    }
    
    .stat-title {
        color: var(--ubs-dark-grey);
        font-family: 'Inter';
        font-size: 14px;
        font-weight: 500;
    }

    .stat-body {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .stat-value {
        color: var(--ubs-blue);
        font-family: 'Inter';
        font-size: 32px;
        font-weight: 700;
        line-height: 1;
    }

    .stat-footer {
        align-items: center;
        display: flex;
        gap: 8px;
    }

    .stat-trend {
        align-items: center;
        display: flex;
        font-family: 'Inter';
        font-size: 14px;
        font-weight: 600;
        gap: 4px;
    }

    .stat-trend.up {
        color: var(--ubs-green);
    }

    .stat-trend.down {
        color: var(--ubs-red);
    }

    .stat-label {
        color: var(--ubs-dark-grey);
        font-family: 'Inter';
        font-size: 14px;
        font-weight: 400;
    }

    /* ========================================
       3. CHARTS ROW
       ======================================== */
    .charts-row {
        display: grid;
        gap: 20px;
        grid-template-columns: 2fr 1fr;
    }

    .chart-card {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 4px 4px -1px rgba(12, 12, 13, 0.1);
        display: flex;
        flex-direction: column;
        padding: 24px;
    }
    
    .chart-title {
        color: var(--ubs-blue);
        font-family: 'Inter';
        font-size: 18px;
        font-weight: 600;
        margin-bottom: 20px;
    }

    .chart-wrapper {
        flex: 1;
        position: relative;
    }

    /* ========================================
       4. DATA TABS SECTION
       ======================================== */
    .tabs-section {
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0px 4px 4px -1px rgba(12, 12, 13, 0.1);
        overflow: hidden;
    }

    .tabs-header {
        border-bottom: 1px solid var(--ubs-light-grey);
        display: flex;
    }

    .tab-button {
        background: transparent;
        border: none;
        border-bottom: 3px solid transparent;
        color: var(--ubs-dark-grey);
        cursor: pointer;
        flex: 1;
        font-family: 'Public Sans';
        font-size: 16px;
        font-weight: 600;
        padding: 16px 24px;
        transition: all 0.2s ease;
    }

    .tab-button:hover {
        background: var(--ubs-background-grey);
        color: var(--ubs-bright-blue);
    }

    .tab-button.active {
        border-bottom-color: var(--ubs-bright-blue);
        color: var(--ubs-bright-blue);
        font-weight: 700;
    }

    .tab-content {
        display: none;
        padding: 24px;
    }

    .tab-content.active {
        display: block;
    }

    /* ========================================
       5. FILTERS TOOLBAR
       ======================================== */
    .filters-toolbar {
        align-items: flex-end;
        display: flex;
        gap: 16px;
        margin-bottom: 20px;
    }

    .filter-group {
        display: flex;
        flex: 1;
        flex-direction: column;
        gap: 8px;
        max-width: 250px;
    }

    .filter-label {
        color: var(--ubs-dark-grey);
        font-family: 'Inter';
        font-size: 14px;
        font-weight: 600;
    }

    .filter-select,
    .filter-input {
        background: #ffffff;
        border: 1px solid var(--ubs-light-grey);
        border-radius: 8px;
        color: var(--ubs-dark-grey);
        font-family: 'Inter';
        font-size: 14px;
        height: 40px;
        padding: 0 12px;
        width: 100%;
    }

    .filter-select {
        cursor: pointer;
    }

    .btn-filter {
        align-items: center;
        background: var(--ubs-blue);
        border: none;
        border-radius: 8px;
        color: #ffffff;
        cursor: pointer;
        display: flex;
        font-family: 'Inter';
        font-size: 14px;
        font-weight: 600;
        gap: 8px;
        height: 40px;
        padding: 0 20px;
        transition: all 0.2s ease;
    }

    .btn-filter:hover {
        background: var(--ubs-dark-blue);
    }

    /* ========================================
       5a. TABLE CONTROLS (ENTRIES & SEARCH)
       ======================================== */
    .table-controls {
        align-items: center;
        display: flex;
        justify-content: space-between;
        margin-bottom: 16px;
        padding: 0 4px;
    }

    .entries-control {
        align-items: center;
        display: flex;
        gap: 8px;
    }

    .entries-label {
        color: var(--ubs-dark-grey);
        font-family: 'Public Sans', sans-serif;
        font-size: 16px;
        font-weight: 500;
        line-height: 19px;
    }

    .entries-select {
        background: #ffffff;
        border: 1px solid var(--ubs-light-grey);
        border-radius: 6px;
        box-sizing: border-box;
        color: var(--ubs-dark-grey);
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        font-weight: 500;
        height: 35px;
        padding: 6px 12px;
        width: 75px;
    }

    .search-control {
        align-items: center;
        display: flex;
        gap: 8px;
    }

    .search-label {
        color: var(--ubs-dark-grey);
        font-family: 'Public Sans', sans-serif;
        font-size: 16px;
        font-weight: 500;
        line-height: 19px;
    }

    .search-input {
        border: 1px solid var(--ubs-dark-grey);
        border-radius: 8px;
        box-sizing: border-box;
        color: var(--ubs-dark-grey);
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        font-weight: 400;
        height: 35px;
        padding: 8px 12px;
        width: 250px;
    }

    .search-input:focus {
        border-color: var(--ubs-bright-blue);
        outline: none;
    }


    /* ========================================
       6. DATA TABLES
       ======================================== */
    .table-container {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        padding: 12px 20px;
        width: 100%;
        overflow-x: auto;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }

    .data-table thead {
        background: var(--ubs-background-grey);
    }

    .data-table th {
        font-family: 'Public Sans';
        font-style: normal;
        font-weight: 700;
        font-size: 16px;
        line-height: 19px;
        color: var(--ubs-dark-grey);
        padding: 12px 8px;
        text-align: left;
        height: 50px;
    }
    
    .data-table th:first-child {
        width: 63px;
        text-align: center;
    }

    .data-table td {
        font-family: 'Poppins';
        font-style: normal;
        font-weight: 400;
        font-size: 16px;
        line-height: 24px;
        color: var(--ubs-dark-grey);
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        padding: 12px 16px;
    }

    .data-table td.center {
        text-align: center;
    }

    .status-badge {
        border-radius: 16px;
        display: inline-block;
        font-size: 12px;
        font-weight: 500;
        padding: 4px 12px;
    }

    .status-badge.open {
        background: rgba(249, 201, 79, 0.3);
        color: var(--ubs-orange);
    }

    .status-badge.closed {
        background: rgba(144, 190, 109, 0.3);
        color: var(--ubs-green);
    }

    .status-badge.active {
        background: rgba(144, 190, 109, 0.3);
        color: var(--ubs-green);
    }

    .status-badge.warning {
        background: rgba(249, 201, 79, 0.3);
        color: var(--ubs-orange);
    }

    .status-badge.expired {
        background: rgba(249, 65, 68, 0.3);
        color: var(--ubs-red);
    }

    /* ========================================
       7. RESPONSIVE
       ======================================== */
    @media (max-width: 1200px) {
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }

        .charts-row {
            grid-template-columns: 1fr;
        }
    }

    @media (max-width: 768px) {
        .stats-row {
            grid-template-columns: 1fr;
        }

        .filters-toolbar {
            flex-direction: column;
        }

        .filter-group {
            max-width: 100%;
        }
    }
</style>

<div class="dashboard-container">
    <!-- ========== STATS CARDS ROW ========== -->
    <div class="stats-row">
        <!-- Card 1: Insiden -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total Insiden</span>
                <div class="stat-icon">
                    <img src="{{ asset('img/icon-insiden.png') }}" alt="Insiden Icon">
                </div>
            </div>
            <div class="stat-value">{{ $stats['insiden']['total'] }}</div>
            <div class="stat-footer">
                <span class="stat-trend {{ $stats['insiden']['trend'] < 0 ? 'down' : 'up' }}">
                    @if($stats['insiden']['trend'] < 0)
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9.5V2.5M6 2.5L2.5 6M6 2.5L9.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @else
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 2.5V9.5M6 9.5L9.5 6M6 9.5L2.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @endif
                    {{ abs($stats['insiden']['trend']) }}%
                </span>
                <span class="stat-label">{{ $stats['insiden']['label'] }}</span>
            </div>
        </div>

        <!-- Card 2: CPAR -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Total CPAR</span>
                <div class="stat-icon">
                    <img src="{{ asset('img/icon-cpar.png') }}" alt="CPAR Icon">
                </div>
            </div>
            <div class="stat-value">{{ $stats['cpar']['total'] }}</div>
            <div class="stat-footer">
                <span class="stat-trend {{ $stats['cpar']['trend'] < 0 ? 'down' : 'up' }}">
                    @if($stats['cpar']['trend'] < 0)
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9.5V2.5M6 2.5L2.5 6M6 2.5L9.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @else
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 2.5V9.5M6 9.5L9.5 6M6 9.5L2.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @endif
                    {{ abs($stats['cpar']['trend']) }}%
                </span>
                <span class="stat-label">{{ $stats['cpar']['label'] }}</span>
            </div>
        </div>

        <!-- Card 3: Completion Rate -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Completion Rate</span>
                <div class="stat-icon">
                    <img src="{{ asset('img/icon-completion.png') }}" alt="Completion Rate Icon">
                </div>
            </div>
            <div class="stat-value">{{ $stats['completion']['total'] }}</div>
            <div class="stat-footer">
                <span class="stat-trend {{ $stats['completion']['trend'] < 0 ? 'down' : 'up' }}">
                    @if($stats['completion']['trend'] < 0)
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9.5V2.5M6 2.5L2.5 6M6 2.5L9.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @else
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 2.5V9.5M6 9.5L9.5 6M6 9.5L2.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @endif
                    {{ abs($stats['completion']['trend']) }}%
                </span>
                <span class="stat-label">{{ $stats['completion']['label'] }}</span>
            </div>
        </div>

        <!-- Card 4: Active Permits -->
        <div class="stat-card">
            <div class="stat-header">
                <span class="stat-title">Active Permits</span>
                <div class="stat-icon">
                    <img src="{{ asset('img/icon-permit.png') }}" alt="Permit Icon">
                </div>
            </div>
            <div class="stat-value">{{ $stats['permit']['total'] }}</div>
            <div class="stat-footer">
                <span class="stat-trend {{ $stats['permit']['trend'] < 0 ? 'down' : 'up' }}">
                    @if($stats['permit']['trend'] < 0)
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 9.5V2.5M6 2.5L2.5 6M6 2.5L9.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @else
                        <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6 2.5V9.5M6 9.5L9.5 6M6 9.5L2.5 6" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    @endif
                    {{ abs($stats['permit']['trend']) }}%
                </span>
                <span class="stat-label">{{ $stats['permit']['label'] }}</span>
            </div>
        </div>
    </div>

    <!-- ========== CHARTS ROW ========== -->
    <div class="charts-row">
        <!-- Line Chart: Trend Insiden -->
        <div class="chart-card">
            <h3 class="chart-title">Trend Insiden Bulanan</h3>
            <div class="chart-wrapper">
                <canvas id="trendChart"></canvas>
            </div>
        </div>

        <!-- Doughnut Chart: Documents -->
        <div class="chart-card">
            <h3 class="chart-title">Total Documents</h3>
            <div class="chart-wrapper">
                <canvas id="documentsChart"></canvas>
            </div>
        </div>
    </div>

    <!-- ========== DATA TABS SECTION ========== -->
    <div class="tabs-section">
        <div class="tabs-header">
            <button class="tab-button active" onclick="openTab(event, 'tab-insiden')">Data Insiden</button>
            <button class="tab-button" onclick="openTab(event, 'tab-cpar')">CPAR</button>
            <button class="tab-button" onclick="openTab(event, 'tab-inspection')">Data Inspection</button>
            <button class="tab-button" onclick="openTab(event, 'tab-permit')">Data Permit</button>
        </div>

        <!-- Tab 1: Data Insiden -->
        <div id="tab-insiden" class="tab-content active">
            <div class="filters-toolbar">
                <div class="filter-group">
                    <label class="filter-label">Departemen</label>
                    <select class="filter-select" id="filter-insiden-dept">
                        <option value="">Semua</option>
                        <option value="Logistik">Logistik</option>
                        <option value="Produksi">Produksi</option>
                        <option value="Umum">Umum</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Kategori</label>
                    <select class="filter-select" id="filter-insiden-kategori">
                        <option value="">Semua</option>
                        <option value="Lalu Lintas">Lalu Lintas</option>
                        <option value="Kecelakaan Kerja">Kecelakaan Kerja</option>
                    </select>
                </div>
                <button class="btn-filter" onclick="filterInsidenTable()">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 14L11 11M12.6667 7.33333C12.6667 10.2789 10.2789 12.6667 7.33333 12.6667C4.38781 12.6667 2 10.2789 2 7.33333C2 4.38781 4.38781 2 7.33333 2C10.2789 2 12.6667 4.38781 12.6667 7.33333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Filter
                </button>
            </div>

            <div class="table-controls">
                <div class="entries-control">
                    <span class="entries-label">Show</span>
                    <select class="entries-select" id="insiden-entries" onchange="handleInsidenEntriesChange()">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="entries-label">entries</span>
                </div>
                
                <div class="search-control">
                    <span class="search-label">Search:</span>
                    <input type="text" class="search-input" id="insiden-search" placeholder="" onkeyup="handleInsidenSearch()">
                </div>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Tanggal</th>
                        <th>Nama Karyawan</th>
                        <th>Nama Departemen</th>
                        <th>Kategori</th>
                        <th>Deskripsi</th>
                    </tr>
                </thead>
                <tbody id="insiden-table-body">
                    @foreach($tableInsiden as $index => $row)
                    <tr data-dept="{{ $row['dept'] }}" data-kategori="{{ $row['kategori'] }}">
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $row['tanggal'] }}</td>
                        <td>{{ $row['nama'] }}</td>
                        <td>{{ $row['dept'] }}</td>
                        <td>{{ $row['kategori'] }}</td>
                        <td>{{ $row['deskripsi'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tab 2: CPAR -->
        <div id="tab-cpar" class="tab-content">
            <div class="filters-toolbar">
                <div class="filter-group">
                    <label class="filter-label">Tipe Audit</label>
                    <select class="filter-select" id="filter-cpar-audit">
                        <option value="">Semua</option>
                        <option value="ISO-9001">ISO-9001</option>
                        <option value="ISO-45001">ISO-45001</option>
                        <option value="ISO-17025">ISO-17025</option>
                        <option value="SNI">SNI</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Kategori</label>
                    <select class="filter-select" id="filter-cpar-kategori">
                        <option value="">Semua</option>
                        <option value="Minor">Minor</option>
                        <option value="Major">Major</option>
                        <option value="Observasi">Observasi</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select class="filter-select" id="filter-cpar-status">
                        <option value="">Semua</option>
                        <option value="Open">Open</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>
                <button class="btn-filter" onclick="filterCPARTable()">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 14L11 11M12.6667 7.33333C12.6667 10.2789 10.2789 12.6667 7.33333 12.6667C4.38781 12.6667 2 10.2789 2 7.33333C2 4.38781 4.38781 2 7.33333 2C10.2789 2 12.6667 4.38781 12.6667 7.33333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Filter
                </button>
            </div>

            <div class="table-controls">
                <div class="entries-control">
                    <span class="entries-label">Show</span>
                    <select class="entries-select" id="cpar-entries" onchange="handleCPAREntriesChange()">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="entries-label">entries</span>
                </div>
                
                <div class="search-control">
                    <span class="search-label">Search:</span>
                    <input type="text" class="search-input" id="cpar-search" placeholder="" onkeyup="handleCPARSearch()">
                </div>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Type Audit</th>
                        <th>Deskripsi Temuan</th>
                        <th>Kategori</th>
                        <th>PIC</th>
                        <th class="center">Status</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody id="cpar-table-body">
                    @foreach($tableCPAR as $index => $row)
                    <tr data-audit="{{ $row['audit'] }}" data-kategori="{{ $row['kategori'] }}" data-status="{{ $row['status'] }}">
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $row['audit'] }}</td>
                        <td>{{ $row['deskripsi'] }}</td>
                        <td>{{ $row['kategori'] }}</td>
                        <td>{{ $row['pic'] }}</td>
                        <td class="center">
                            <span class="status-badge {{ strtolower($row['status']) }}">{{ $row['status'] }}</span>
                        </td>
                        <td>{{ $row['deadline'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tab 3: Data Inspection -->
        <div id="tab-inspection" class="tab-content">
            <div class="filters-toolbar">
                <div class="filter-group">
                    <label class="filter-label">Periode</label>
                    <input type="month" class="filter-input" id="filter-inspection-periode">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Departemen</label>
                    <select class="filter-select" id="filter-inspection-dept">
                        <option value="">Semua</option>
                        <option value="Umum">Umum</option>
                        <option value="Produksi">Produksi</option>
                        <option value="Logistik">Logistik</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select class="filter-select" id="filter-inspection-status">
                        <option value="">Semua</option>
                        <option value="Open">Open</option>
                        <option value="Closed">Closed</option>
                    </select>
                </div>
                <button class="btn-filter" onclick="filterInspectionTable()">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 14L11 11M12.6667 7.33333C12.6667 10.2789 10.2789 12.6667 7.33333 12.6667C4.38781 12.6667 2 10.2789 2 7.33333C2 4.38781 4.38781 2 7.33333 2C10.2789 2 12.6667 4.38781 12.6667 7.33333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Filter
                </button>
            </div>

            <div class="table-controls">
                <div class="entries-control">
                    <span class="entries-label">Show</span>
                    <select class="entries-select" id="inspection-entries" onchange="handleInspectionEntriesChange()">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="entries-label">entries</span>
                </div>
                
                <div class="search-control">
                    <span class="search-label">Search:</span>
                    <input type="text" class="search-input" id="inspection-search" placeholder="" onkeyup="handleInspectionSearch()">
                </div>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Periode</th>
                        <th>Departemen</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th class="center">Status</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody id="inspection-table-body">
                    @foreach($tableInspection as $index => $row)
                    <tr data-periode="{{ $row['periode'] }}" data-dept="{{ $row['dept'] }}" data-kategori="{{ $row['kategori'] }}" data-status="{{ $row['status'] }}">
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $row['periode'] }}</td>
                        <td>{{ $row['dept'] }}</td>
                        <td>{{ $row['deskripsi'] }}</td>
                        <td>{{ $row['kategori'] }}</td>
                        <td class="center">
                            <span class="status-badge {{ strtolower($row['status']) }}">{{ $row['status'] }}</span>
                        </td>
                        <td>{{ $row['deadline'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Tab 4: Data Permit -->
        <div id="tab-permit" class="tab-content">
            <div class="filters-toolbar">
                <div class="filter-group">
                    <label class="filter-label">Periode</label>
                    <input type="month" class="filter-input" id="filter-permit-periode">
                </div>
                <div class="filter-group">
                    <label class="filter-label">Departemen</label>
                    <select class="filter-select" id="filter-permit-dept">
                        <option value="">Semua</option>
                        <option value="Logistik">Logistik</option>
                        <option value="Umum">Umum</option>
                        <option value="Produksi">Produksi</option>
                    </select>
                </div>
                <div class="filter-group">
                    <label class="filter-label">Status</label>
                    <select class="filter-select" id="filter-permit-status">
                        <option value="">Semua</option>
                        <option value="Active">Active</option>
                        <option value="Warning">Warning</option>
                        <option value="Expired">Expired</option>
                    </select>
                </div>
                <button class="btn-filter" onclick="filterPermitTable()">
                    <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M14 14L11 11M12.6667 7.33333C12.6667 10.2789 10.2789 12.6667 7.33333 12.6667C4.38781 12.6667 2 10.2789 2 7.33333C2 4.38781 4.38781 2 7.33333 2C10.2789 2 12.6667 4.38781 12.6667 7.33333Z" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Filter
                </button>
            </div>

            <div class="table-controls">
                <div class="entries-control">
                    <span class="entries-label">Show</span>
                    <select class="entries-select" id="permit-entries" onchange="handlePermitEntriesChange()">
                        <option value="5">5</option>
                        <option value="10" selected>10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select>
                    <span class="entries-label">entries</span>
                </div>
                
                <div class="search-control">
                    <span class="search-label">Search:</span>
                    <input type="text" class="search-input" id="permit-search" placeholder="" onkeyup="handlePermitSearch()">
                </div>
            </div>

            <table class="data-table">
                <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Periode</th>
                        <th>Departemen</th>
                        <th>Deskripsi</th>
                        <th>Kategori</th>
                        <th class="center">Status</th>
                        <th>Deadline</th>
                    </tr>
                </thead>
                <tbody id="permit-table-body">
                    @foreach($tablePermit as $index => $row)
                    <tr data-periode="{{ $row['periode'] }}" data-dept="{{ $row['dept'] }}" data-kategori="{{ $row['kategori'] }}" data-status="{{ $row['status'] }}">
                        <td class="center">{{ $index + 1 }}</td>
                        <td>{{ $row['periode'] }}</td>
                        <td>{{ $row['dept'] }}</td>
                        <td>{{ $row['deskripsi'] }}</td>
                        <td>{{ $row['kategori'] }}</td>
                        <td class="center">
                            <span class="status-badge {{ strtolower($row['status']) }}">{{ $row['status'] }}</span>
                        </td>
                        <td>{{ $row['deadline'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            </table>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // ========== TAB SWITCHING ==========
    function openTab(evt, tabId) {
        const tabContents = document.querySelectorAll('.tab-content');
        tabContents.forEach(content => content.classList.remove('active'));

        const tabButtons = document.querySelectorAll('.tab-button');
        tabButtons.forEach(button => button.classList.remove('active'));

        document.getElementById(tabId).classList.add('active');
        evt.currentTarget.classList.add('active');
    }

    // ========== CHART: TREND INSIDEN ==========
    const trendCtx = document.getElementById('trendChart').getContext('2d');
    const trendChart = new Chart(trendCtx, {
        type: 'line',
        data: {
            labels: @json($chartLabels),
            datasets: [
                {
                    label: 'Kecelakaan Kerja',
                    data: @json($chartKerja),
                    borderColor: '#2090e0',
                    backgroundColor: 'rgba(32, 144, 224, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#2090e0'
                },
                {
                    label: 'Kecelakaan Lalu Lintas',
                    data: @json($chartLalin),
                    borderColor: '#e3982f',
                    backgroundColor: 'rgba(227, 152, 47, 0.1)',
                    tension: 0.4,
                    fill: true,
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#e3982f'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 2.5,
            plugins: {
                legend: {
                    position: 'top',
                    align: 'start',
                    labels: {
                        usePointStyle: true,
                        padding: 15,
                        font: {
                            family: 'Public Sans',
                            size: 12
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        stepSize: 1,
                        font: {
                            family: 'Public Sans'
                        }
                    },
                    grid: {
                        color: '#F2F4F7'
                    }
                },
                x: {
                    ticks: {
                        font: {
                            family: 'Public Sans'
                        }
                    },
                    grid: {
                        display: false
                    }
                }
            }
        }
    });

    // ========== CHART: DOCUMENTS DOUGHNUT ==========
    const docsCtx = document.getElementById('documentsChart').getContext('2d');
    const docsChart = new Chart(docsCtx, {
        type: 'doughnut',
        data: {
            labels: @json($pieLabels),
            datasets: [{
                data: @json($pieData),
                backgroundColor: @json($pieColors),
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
            aspectRatio: 1.5,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: {
                        padding: 15,
                        usePointStyle: true,
                        font: {
                            family: 'Public Sans',
                            size: 12
                        }
                    }
                }
            }
        }
    });

    // ==========================================
    // FILTER FUNCTIONS (DRY PRINCIPLE)
    // ==========================================
    
    /**
     * Generic filter function for table rows
     * @param {string} tableBodyId - ID of the table body element
     * @param {Object} filters - Object with filter IDs and their corresponding dataset keys
     */
    function filterTable(tableBodyId, filters) {
        const rows = document.querySelectorAll(`#${tableBodyId} tr`);
        
        // Get all filter values
        const filterValues = {};
        for (const [filterKey, datasetKey] of Object.entries(filters)) {
            const element = document.getElementById(filterKey);
            filterValues[datasetKey] = element ? element.value.toLowerCase() : '';
        }
        
        // Apply filters to each row
        rows.forEach(row => {
            let showRow = true;
            
            for (const [datasetKey, filterValue] of Object.entries(filterValues)) {
                if (filterValue) {
                    const rowValue = (row.dataset[datasetKey] || '').toLowerCase();
                    if (!rowValue.includes(filterValue)) {
                        showRow = false;
                        break;
                    }
                }
            }
            
            row.style.display = showRow ? '' : 'none';
        });
    }
    
    /**
     * Filter Insiden table
     */
    function filterInsidenTable() {
        filterTable('insiden-table-body', {
            'filter-insiden-dept': 'dept',
            'filter-insiden-kategori': 'kategori'
        });
    }
    
    /**
     * Filter CPAR table
     */
    function filterCPARTable() {
        filterTable('cpar-table-body', {
            'filter-cpar-audit': 'audit',
            'filter-cpar-kategori': 'kategori',
            'filter-cpar-status': 'status'
        });
    }
    
    /**
     * Filter Inspection table
     */
    function filterInspectionTable() {
        filterTable('inspection-table-body', {
            'filter-inspection-periode': 'periode',
            'filter-inspection-dept': 'dept',
            'filter-inspection-status': 'status'
        });
    }
    
    /**
     * Filter Permit table
     */
    function filterPermitTable() {
        filterTable('permit-table-body', {
            'filter-permit-dept': 'dept',
            'filter-permit-status': 'status'
        });
    }

    // ==========================================
    // ENTRIES CONTROL FUNCTIONS
    // ==========================================
    
    /**
     * Handle entries per page change for Insiden table
     */
    function handleInsidenEntriesChange() {
        const entriesPerPage = parseInt(document.getElementById('insiden-entries').value);
        const rows = document.querySelectorAll('#insiden-table-body tr');
        
        rows.forEach((row, index) => {
            row.style.display = index < entriesPerPage ? '' : 'none';
        });
    }
    
    /**
     * Handle entries per page change for CPAR table
     */
    function handleCPAREntriesChange() {
        const entriesPerPage = parseInt(document.getElementById('cpar-entries').value);
        const rows = document.querySelectorAll('#cpar-table-body tr');
        
        rows.forEach((row, index) => {
            row.style.display = index < entriesPerPage ? '' : 'none';
        });
    }
    
    /**
     * Handle entries per page change for Inspection table
     */
    function handleInspectionEntriesChange() {
        const entriesPerPage = parseInt(document.getElementById('inspection-entries').value);
        const rows = document.querySelectorAll('#inspection-table-body tr');
        
        rows.forEach((row, index) => {
            row.style.display = index < entriesPerPage ? '' : 'none';
        });
    }
    
    /**
     * Handle entries per page change for Permit table
     */
    function handlePermitEntriesChange() {
        const entriesPerPage = parseInt(document.getElementById('permit-entries').value);
        const rows = document.querySelectorAll('#permit-table-body tr');
        
        rows.forEach((row, index) => {
            row.style.display = index < entriesPerPage ? '' : 'none';
        });
    }

    // ==========================================
    // SEARCH FUNCTIONS
    // ==========================================
    
    /**
     * Handle search for Insiden table
     */
    function handleInsidenSearch() {
        const searchTerm = document.getElementById('insiden-search').value.toLowerCase();
        const rows = document.querySelectorAll('#insiden-table-body tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    }
    
    /**
     * Handle search for CPAR table
     */
    function handleCPARSearch() {
        const searchTerm = document.getElementById('cpar-search').value.toLowerCase();
        const rows = document.querySelectorAll('#cpar-table-body tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    }
    
    /**
     * Handle search for Inspection table
     */
    function handleInspectionSearch() {
        const searchTerm = document.getElementById('inspection-search').value.toLowerCase();
        const rows = document.querySelectorAll('#inspection-table-body tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    }
    
    /**
     * Handle search for Permit table
     */
    function handlePermitSearch() {
        const searchTerm = document.getElementById('permit-search').value.toLowerCase();
        const rows = document.querySelectorAll('#permit-table-body tr');
        
        rows.forEach(row => {
            const text = row.textContent.toLowerCase();
            row.style.display = text.includes(searchTerm) ? '' : 'none';
        });
    }

    // Initialize: Show only first 10 entries on page load
    document.addEventListener('DOMContentLoaded', function() {
        handleInsidenEntriesChange();
        handleCPAREntriesChange();
        handleInspectionEntriesChange();
        handlePermitEntriesChange();
    });
</script>
@endsection
