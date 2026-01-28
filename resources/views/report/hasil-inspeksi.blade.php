@php
    // ========== DATA FETCHING ==========
    // TODO: Replace this section with controller data when backend is ready
    // Expected controller code:
    //   $inspections = QHSInspectH::with(['details', 'inspectors', 'departemen', 'lokasi'])->get();
    //   return view('report.hasil-inspeksi', compact('inspections'));
    
    // DUMMY DATA - DELETE THIS BLOCK WHEN SWITCHING TO DATABASE
    // Simplified data matching screenshot
    $tableData = [
        [
            'no_dokumen' => 'INS-001',
            'tanggal' => '2026-01-13',
            'kode_dept' => 'MKT',
            'departemen' => 'MKT EKSPOR',
            'jumlah' => 4,
            'open' => 0,
            'closed' => 4,
            'percent_complete' => 100,
            'tgl_perbaikan' => '2026-01-23',
            'percent_perbaikan' => 100
        ],
        [
            'no_dokumen' => 'INS-002',
            'tanggal' => '2026-01-27',
            'kode_dept' => 'COR',
            'departemen' => 'COR',
            'jumlah' => 2,
            'open' => 0,
            'closed' => 2,
            'percent_complete' => 100,
            'tgl_perbaikan' => '2026-1-29',
            'percent_perbaikan' => 50
        ],
        [
            'no_dokumen' => 'INS-003',
            'tanggal' => '2026-1-28',
            'kode_dept' => 'HOLLOW',
            'departemen' => 'HOLLOW',
            'jumlah' => 1,
            'open' => 0,
            'closed' => 1,
            'percent_complete' => 100,
            'tgl_perbaikan' => '2025-10-30',
            'percent_perbaikan' => 100
        ],
        [
            'no_dokumen' => 'INS-004',
            'tanggal' => '2025-11-15',
            'kode_dept' => 'MKT',
            'departemen' => 'MKT EKSPOR',
            'jumlah' => 3,
            'open' => 1,
            'closed' => 2,
            'percent_complete' => 67,
            'tgl_perbaikan' => '2025-11-20',
            'percent_perbaikan' => 33
        ],
        [
            'no_dokumen' => 'INS-005',
            'tanggal' => '2025-12-05',
            'kode_dept' => 'COR',
            'departemen' => 'COR',
            'jumlah' => 5,
            'open' => 5,
            'closed' => 0,
            'percent_complete' => 0,
            'tgl_perbaikan' => '-',
            'percent_perbaikan' => 0
        ],
        [
            'no_dokumen' => 'INS-006',
            'tanggal' => '2025-12-18',
            'kode_dept' => 'HOLLOW',
            'departemen' => 'HOLLOW',
            'jumlah' => 2,
            'open' => 1,
            'closed' => 1,
            'percent_complete' => 50,
            'tgl_perbaikan' => '2025-12-22',
            'percent_perbaikan' => 50
        ]
    ];
    // END DUMMY DATA
@endphp

@extends('layouts.dashboard')

@section('page-title')
<h1 class="page-title-header"><span class="breadcrumb-parent">Report</span> / <span class="breadcrumb-active">Hasil Inspeksi</span></h1>
@endsection

@section('content')
<style>
    /* ========================================
       1. LAYOUT & STRUCTURE
       ======================================== */
    .floating-header-card {
        justify-content: space-between !important;
    }

    .page-title-header {
        color: #98A2B3;
        flex: none;
        flex-grow: 0;
        font-family: var(--ubs-font-sidebar);
        font-size: 20px;
        font-style: normal;
        font-weight: 700;
        height: 24px;
        line-height: 24px;
        margin: 0;
        order: 0;
        width: auto;
    }

    .hasil-inspeksi-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        width: 100%;
    }

    /* ========================================
       2. TABS - CONTAINER & ITEMS
       ======================================== */
    .tabs-section {
        background: #FFFFFF;
        border-radius: 12px;
        box-shadow: 0px 4px 4px -1px rgba(12, 12, 13, 0.1);
        overflow: hidden;
        padding: 0;
    }

    .tabs-container {
        border-bottom: 1px solid var(--ubs-light-grey);
        display: flex;
    }

    .tab-item {
        border-bottom: 3px solid transparent;
        color: #667085;
        cursor: pointer;
        flex: 1;
        font-family: var(--ubs-font-sidebar);
        font-size: 16px;
        font-weight: 700;
        padding: 4px 24px;
        text-align: center;
        transition: all 0.2s ease;
    }

    .tab-item:hover {
        background: var(--ubs-background-grey);
        color: var(--ubs-bright-blue);
    }

    .tab-item.active {
        border-bottom-color: var(--ubs-bright-blue);
        color: var(--ubs-bright-blue);
    }

    /* ========================================
       3. FILTER SECTION
       ======================================== */
    .filter-section {
        background: #FFFFFF;
        border-radius: 12px;
        box-shadow: 0px 4px 4px -1px rgba(12, 12, 13, 0.1);
        display: flex;
        flex-direction: column;
        gap: 16px;
        padding: 24px;
    }

    .filter-title {
        color: var(--ubs-blue);
        font-family: var(--ubs-font-sidebar);
        font-size: 18px;
        font-weight: 600;
        margin: 0;
    }

    .filter-inputs {
        align-items: flex-end;
        display: flex;
        gap: 16px;
    }

    .filter-group {
        display: flex;
        flex: 1;
        flex-direction: column;
        gap: 8px;
    }

    .filter-label {
        color: var(--ubs-dark-grey);
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        font-weight: 600;
    }

    .filter-input-wrapper {
        position: relative;
    }

    .filter-input {
        background: #FFFFFF;
        border: 1px solid #D0D5DD;
        border-radius: 8px;
        color: var(--ubs-dark-grey);
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        height: 46px;
        padding: 0 14px 0 36px;
        transition: all 0.2s ease;
        width: 100%;
    }

    .filter-input:focus {
        border-color: var(--ubs-blue);
        box-shadow: 0 0 0 3px rgba(18, 68, 119, 0.1);
        outline: none;
    }

    .filter-select {
        appearance: none;
        background: #FFFFFF;
        background-image: url("data:image/svg+xml,%3Csvg width='10' height='6' viewBox='0 0 10 6' fill='none' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M0.666016 0.666504L4.66602 4.6665L8.66602 0.666504' stroke='black' stroke-width='1.33333' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E");
        background-position: right 14px center;
        background-repeat: no-repeat;
        border: 1px solid #D0D5DD;
        border-radius: 8px;
        color: var(--ubs-dark-grey);
        cursor: pointer;
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        height: 46px;
        padding: 0 36px 0 14px;
        transition: all 0.2s ease;
        width: 100%;
    }

    .filter-select:focus {
        border-color: var(--ubs-blue);
        box-shadow: 0 0 0 3px rgba(18, 68, 119, 0.1);
        outline: none;
    }

    .filter-icon {
        left: 14px;
        pointer-events: none;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .btn-filter {
        align-items: center;
        background: var(--ubs-blue);
        border: none;
        border-radius: 8px;
        color: #FFFFFF;
        cursor: pointer;
        display: flex;
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        font-weight: 600;
        gap: 8px;
        height: 46px;
        padding: 0 24px;
        transition: all 0.2s ease;
    }

    .btn-filter:hover {
        background: var(--ubs-dark-blue);
        box-shadow: 0 4px 12px rgba(18, 68, 119, 0.2);
        transform: translateY(-1px);
    }

    /* ========================================
       4. DATA TABLE - STRUCTURE & HEADER
       ======================================== */
    .table-section {
        background: #FFFFFF;
        border-radius: 12px;
        box-shadow: 0px 4px 4px -1px rgba(12, 12, 13, 0.1);
        display: none;
        overflow-x: auto;
    }

    .table-section.visible {
        display: block;
    }

    .table-header {
        align-items: center;
        border-bottom: 1px solid #D0D5DD;
        display: flex;
        height: 70px;
        justify-content: space-between;
        padding: 0 20px;
    }

    .table-title {
        color: var(--ubs-bright-blue);
        font-family: var(--ubs-font-sidebar);
        font-size: 20px;
        font-weight: 600;
        margin: 0;
    }

    .btn-export {
        align-items: center;
        background: var(--ubs-bright-blue);
        border: none;
        border-radius: 8px;
        color: #FFFFFF;
        cursor: pointer;
        display: flex;
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        font-weight: 600;
        gap: 8px;
        padding: 8px 16px;
        transition: background 0.2s ease;
    }

    .btn-export:hover {
        background: var(--ubs-blue);
    }

    /* ========================================
       5. DATA TABLE - CONTROLS & SEARCH
       ======================================== */
    .table-controls {
        align-items: center;
        border-bottom: 1px solid var(--ubs-lighter-grey);
        display: flex;
        justify-content: space-between;
        padding: 16px 20px;
    }

    .controls-left {
        align-items: center;
        color: var(--ubs-dark-grey);
        display: flex;
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        gap: 8px;
    }

    .controls-left select {
        background: #FFFFFF;
        border: 1px solid #D0D5DD;
        border-radius: 6px;
        color: var(--ubs-dark-grey);
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        padding: 6px 12px;
    }

    .controls-right {
        align-items: center;
        display: flex;
        gap: 8px;
    }

    .search-label {
        color: var(--ubs-dark-grey);
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
    }

    .search-input-wrapper {
        position: relative;
    }

    .search-input {
        background: #FFFFFF;
        border: 1px solid #D0D5DD;
        border-radius: 6px;
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        padding: 8px 12px 8px 36px;
        width: 200px;
    }

    .search-icon {
        left: 10px;
        pointer-events: none;
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    /* ========================================
       6. DATA TABLE - TABLE STRUCTURE & CELLS
       ======================================== */
    .inspeksi-table {
        border-collapse: collapse;
        width: 100%;
    }

    .inspeksi-table thead tr {
        background: #F5FBFF;
        height: 45px;
    }

    .inspeksi-table th {
        border-bottom: 1px solid var(--ubs-light-grey);
        color: var(--ubs-dark-grey);
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        font-weight: 700;
        padding: 0px 20px;
        text-align: left;
        vertical-align: middle;
        white-space: nowrap;
    }

    .inspeksi-table th.center {
        text-align: center;
    }

    .inspeksi-table tbody tr {
        border-bottom: 1px solid var(--ubs-lighter-grey);
        height: 45px;
    }

    .inspeksi-table tbody tr:hover {
        background: var(--ubs-background-grey);
    }

    .inspeksi-table tbody tr.empty-state {
        height: 120px;
    }

    .inspeksi-table tbody tr.empty-state:hover {
        background: transparent;
    }

    .inspeksi-table td {
        color: var(--ubs--black);
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
        font-weight: 400;
        padding: 0px 20px;
        vertical-align: middle;
        white-space: nowrap;
    }

    .inspeksi-table td.center {
        text-align: center;
    }

    .empty-message {
        color: #98A2B3;
        font-style: italic;
        text-align: center;
    }

    /* ========================================
       7. STATUS BADGES
       ======================================== */
    .status-badge {
        border-radius: 16px;
        display: inline-block;
        font-family: var(--ubs-font-sidebar);
        font-size: 12px;
        font-weight: 500;
        padding: 4px 12px;
    }

    .status-badge.complete {
        background: #D1FADF;
        color: #039855;
    }

    .status-badge.partial {
        background: #FEF0C7;
        color: #DC6803;
    }

    .status-badge.incomplete {
        background: #FEE4E2;
        color: #D92D20;
    }

    /* ========================================
       8. TABLE FOOTER & PAGINATION
       ======================================== */
    .table-footer {
        align-items: center;
        display: flex;
        justify-content: space-between;
        padding: 16px 20px;
    }

    .footer-info {
        color: #667085;
        font-family: var(--ubs-font-sidebar);
        font-size: 14px;
    }

    .pagination {
        align-items: center;
        display: flex;
        gap: 8px;
    }

    .pagination-btn {
        align-items: center;
        background: #FFFFFF;
        border: 1px solid #D0D5DD;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        height: 32px;
        justify-content: center;
        transition: all 0.2s ease;
        width: 32px;
    }

    .pagination-btn:hover:not(:disabled) {
        background: #F9FAFB;
        border-color: #0B4A6F;
    }

    .pagination-btn:disabled {
        cursor: not-allowed;
        opacity: 0.4;
    }
</style>

<div class="hasil-inspeksi-container">
    <!-- ========== TABS SECTION ========== -->
    <div class="tabs-section">
        <div class="tabs-container">
            <div class="tab-item active" onclick="switchTab('mutu')">Mutu</div>
            <div class="tab-item" onclick="switchTab('k3')">K3</div>
        </div>
    </div>

    <!-- ========== FILTER SECTION ========== -->
    <div class="filter-section">
        <div class="filter-inputs">
            <!-- Periode -->
            <div class="filter-group">
                <label class="filter-label">Periode</label>
                <div class="filter-input-wrapper">
                    <span class="filter-icon">
                        <svg width="12" height="14" viewBox="0 0 12 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2.66667 6H4V7.33333H2.66667V6ZM12 2.66667V12C12 12.7333 11.4 13.3333 10.6667 13.3333H1.33333C0.593333 13.3333 0 12.7333 0 12L0.00666666 2.66667C0.00666666 1.93333 0.593333 1.33333 1.33333 1.33333H2V0H3.33333V1.33333H8.66667V0H10V1.33333H10.6667C11.4 1.33333 12 1.93333 12 2.66667ZM1.33333 4H10.6667V2.66667H1.33333V4ZM10.6667 12V5.33333H1.33333V12H10.6667ZM8 7.33333H9.33333V6H8V7.33333ZM5.33333 7.33333H6.66667V6H5.33333V7.33333Z" fill="black"/>
                        </svg>
                    </span>
                    <input type="month" id="filterPeriode" class="filter-input">
                </div>
            </div>

            <!-- Departemen -->
            <div class="filter-group">
                <label class="filter-label">Departemen</label>
                <select id="filterDepartemen" class="filter-select">
                    <option value="">Semua Departemen</option>
                    <option value="MKT">MKT EKSPOR</option>
                    <option value="COR">COR</option>
                    <option value="HOLLOW">HOLLOW</option>
                </select>
            </div>

            <!-- Status Temuan -->
            <div class="filter-group">
                <label class="filter-label">Status Temuan</label>
                <select id="filterStatus" class="filter-select">
                    <option value="">Semua Status</option>
                    <option value="complete">Complete (100%)</option>
                    <option value="partial">Partial (1-99%)</option>
                    <option value="incomplete">Incomplete (0%)</option>
                </select>
            </div>

            <!-- Filter Button -->
            <button class="btn-filter" onclick="applyFilter()">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16 16L12.375 12.375M14.3333 7.66667C14.3333 11.3486 11.3486 14.3333 7.66667 14.3333C3.98477 14.3333 1 11.3486 1 7.66667C1 3.98477 3.98477 1 7.66667 1C11.3486 1 14.3333 3.98477 14.3333 7.66667Z" stroke="#FCFAFF" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                Filter
            </button>
        </div>
    </div>

    <!-- ========== DATA TABLE SECTION ========== -->
    <div class="table-section" id="tableSection">
        <!-- Table Header -->
        <div class="table-header">
            <h2 class="table-title">List Hasil Inspeksi</h2>
            <button class="btn-export">
                <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.167 13V13.667H0.5V13H11.167ZM7.83301 0.5V5.5H10.46L5.83301 10.126L1.20703 5.5H3.83301V0.5H7.83301ZM4.5 6.16699H2.81836L5.83301 9.18164L6.18652 8.82812L7.99512 7.02051L8.84863 6.16699H7.16699V1.16699H4.5V6.16699Z" fill="black" stroke="#FCFAFF"/>
                </svg>
                Export
            </button>
        </div>

        <!-- Table Controls -->
        <div class="table-controls">
            <div class="controls-left">
                <span>Show</span>
                <select id="entriesPerPage" onchange="updateEntriesDisplay()">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
                <span>entries</span>
            </div>
            <div class="controls-right">
                <span class="search-label">Search:</span>
                <div class="search-input-wrapper">
                    <span class="search-icon">
                        <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16 16L12.375 12.375M14.3333 7.66667C14.3333 11.3486 11.3486 14.3333 7.66667 14.3333C3.98477 14.3333 1 11.3486 1 7.66667C1 3.98477 3.98477 1 7.66667 1C11.3486 1 14.3333 3.98477 14.3333 7.66667Z" stroke="#98A2B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </span>
                    <input type="text" id="searchInput" class="search-input" placeholder="" onkeyup="filterTable()">
                </div>
            </div>
        </div>

        <!-- Table -->
        <table class="inspeksi-table">
            <thead>
                <tr>
                    <th class="center">#</th>
                    <th>Tgl Inspeksi</th>
                    <th>Departemen</th>
                    <th class="center">Jumlah</th>
                    <th class="center">Open</th>
                    <th class="center">Closed</th>
                    <th class="center">%</th>
                    <th>Tgl Perbaikan</th>
                    <th class="center">(%) Semua Perbaikan</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <tr class="empty-state">
                    <td colspan="9" class="empty-message">
                        Harap filter periode / departemen / status terlebih dahulu
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Table Footer -->
        <div class="table-footer">
            <div class="footer-info" id="footerInfo">
                Showing 0 entries
            </div>
            <div class="pagination">
                <button class="pagination-btn" id="prevBtn" disabled>
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6 11L1 6L6 1" stroke="#98A2B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
                <button class="pagination-btn" id="nextBtn" disabled>
                    <svg width="7" height="12" viewBox="0 0 7 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1 11L6 6L1 1" stroke="#98A2B3" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<script>
    // ========== GLOBAL STATE ==========
    const fullTableData = @json($tableData);
    let filteredData = [];
    let currentPage = 1;
    let entriesPerPage = 5;
    let activeTab = 'mutu';

    // ========== HELPER FUNCTIONS ==========
    function formatDate(dateStr) {
        if (!dateStr || dateStr === '-') return '-';
        const date = new Date(dateStr);
        return date.toLocaleDateString('id-ID', { day: '2-digit', month: 'short', year: 'numeric' });
    }

    function getStatusBadge(percentComplete) {
        if (percentComplete === 100) {
            return '<span class="status-badge complete">Complete</span>';
        } else if (percentComplete === 0) {
            return '<span class="status-badge incomplete">Incomplete</span>';
        } else {
            return '<span class="status-badge partial">In Progress</span>';
        }
    }

    function resetTableToEmptyState() {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = `
            <tr class="empty-state">
                <td colspan="9" class="empty-message">
                    Harap filter periode / departemen / status terlebih dahulu
                </td>
            </tr>
        `;
    }

    function showNoDataMessage() {
        const tbody = document.getElementById('tableBody');
        tbody.innerHTML = `
            <tr class="empty-state">
                <td colspan="9" class="empty-message">
                    Tidak ada data ditemukan
                </td>
            </tr>
        `;
    }

    // ========== TAB FUNCTIONS ==========
    function switchTab(tab) {
        activeTab = tab;
        
        const tabs = document.querySelectorAll('.tab-item');
        tabs.forEach(tabEl => {
            tabEl.classList.remove('active');
        });
        event.currentTarget.classList.add('active');
        
        document.getElementById('filterPeriode').value = '';
        document.getElementById('filterDepartemen').value = '';
        document.getElementById('filterStatus').value = '';
        document.getElementById('searchInput').value = '';
        
        document.getElementById('tableSection').classList.remove('visible');
        filteredData = [];
        currentPage = 1;
        
        resetTableToEmptyState();
    }

    // ========== FILTER FUNCTIONS ==========
    function applyFilter() {
        const periode = document.getElementById('filterPeriode').value;
        const departemen = document.getElementById('filterDepartemen').value;
        const status = document.getElementById('filterStatus').value;
        
        filteredData = fullTableData.filter(row => {
            let matches = true;
            
            if (periode) {
                const [selectedYear, selectedMonth] = periode.split('-').map(Number);
                const rowDate = new Date(row.tanggal);
                if (selectedYear !== rowDate.getFullYear() || 
                    selectedMonth !== (rowDate.getMonth() + 1)) {
                    matches = false;
                }
            }
            
            if (departemen && row.kode_dept !== departemen) {
                matches = false;
            }
            
            if (status) {
                if (status === 'complete' && row.percent_complete !== 100) matches = false;
                if (status === 'partial' && (row.percent_complete === 0 || row.percent_complete === 100)) matches = false;
                if (status === 'incomplete' && row.percent_complete !== 0) matches = false;
            }
            
            return matches;
        });
        
        document.getElementById('tableSection').classList.add('visible');
        currentPage = 1;
        renderTable();
    }

    function filterTable() {
        currentPage = 1;
        renderTable();
    }

    function updateEntriesDisplay() {
        entriesPerPage = parseInt(document.getElementById('entriesPerPage').value);
        currentPage = 1;
        renderTable();
    }

    // ========== RENDER FUNCTIONS ==========
    function renderTable() {
        const tbody = document.getElementById('tableBody');
        const searchTerm = document.getElementById('searchInput').value.toLowerCase();
        
        let displayData = filteredData.filter(row => {
            return row.no_dokumen.toLowerCase().includes(searchTerm) ||
                   row.departemen.toLowerCase().includes(searchTerm);
        });
        
        const startIndex = (currentPage - 1) * entriesPerPage;
        const endIndex = Math.min(startIndex + entriesPerPage, displayData.length);
        const pageData = displayData.slice(startIndex, endIndex);
        
        tbody.innerHTML = '';
        
        if (pageData.length === 0) {
            showNoDataMessage();
            updateFooter(0, 0, 0);
            return;
        }
        
        pageData.forEach((row, index) => {
            const rowNum = startIndex + index + 1;
            const statusBadge = getStatusBadge(row.percent_complete);
            
            tbody.innerHTML += `
                <tr class="data-row">
                    <td class="center">${rowNum}</td>
                    <td>${formatDate(row.tanggal)}</td>
                    <td>${row.departemen}</td>
                    <td class="center">${row.jumlah}</td>
                    <td class="center">${row.open}</td>
                    <td class="center">${row.closed}</td>
                    <td class="center">${row.percent_complete}%</td>
                    <td>${formatDate(row.tgl_perbaikan)}</td>
                    <td class="center">${row.percent_perbaikan}%</td>
                </tr>
            `;
        });
        
        updateFooter(startIndex + 1, endIndex, displayData.length);
    }

    function updateFooter(start, end, total) {
        const footerInfo = document.getElementById('footerInfo');
        if (total === 0) {
            footerInfo.textContent = 'Showing 0 entries';
        } else {
            footerInfo.textContent = `Showing ${start} to ${end} of ${total} entries`;
        }
        
        const totalPages = Math.ceil(total / entriesPerPage);
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = currentPage >= totalPages || total === 0;
    }

    // ========== EVENT LISTENERS ==========
    document.getElementById('prevBtn').addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            renderTable();
        }
    });

    document.getElementById('nextBtn').addEventListener('click', () => {
        const totalPages = Math.ceil(filteredData.length / entriesPerPage);
        if (currentPage < totalPages) {
            currentPage++;
            renderTable();
        }
    });
</script>

@endsection
