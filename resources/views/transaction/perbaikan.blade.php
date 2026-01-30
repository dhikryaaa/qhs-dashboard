@php
    // ========== DUMMY DATA ==========
    $improvements = [
        [
            'id' => 1,
            'tgl_inspeksi' => '23 Oktober 2025',
            'lokasi' => 'Gudang',
            'deskripsi' => 'Terdapat lampu yang terlepas skrupnya.',
            'saran' => 'Koreksi: Memperbaiki perekatan lampu. Korektif: Kontrol kondisi infrastruktur.',
            'status' => 'PENDING',
            'bukti_image' => asset('img/hero-warehouse.jpg'),
            'dokumen_image' => asset('img/login-bg-smoke.jpg')
        ],
        [
            'id' => 2,
            'tgl_inspeksi' => '24 Oktober 2025',
            'lokasi' => 'Produksi',
            'deskripsi' => 'Kabel terkelupas di area packing.',
            'saran' => 'Ganti kabel dan pasang pelindung.',
            'status' => 'SENT',
            'bukti_image' => asset('img/login-bg-smoke.jpg'),
            'dokumen_image' => asset('img/hero-warehouse.jpg')
        ]
    ];
@endphp

@extends('layouts.app')

@section('page-title')
<h1 class="page-title-header"><span class="breadcrumb-parent">Transaksi</span> / <span class="breadcrumb-active">Perbaikan</span></h1>
@endsection

@section('content')
<style>
    /* ========================================
       1. LAYOUT & STRUCTURE
       ======================================== */
    .floating-header-card {
        justify-content: space-between !important;
    }

    .perbaikan-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
        width: 100%;
    }

    .page-title-header {
        color: var(--ubs-dark-grey);
        font-family: 'Public Sans', sans-serif;
        font-size: 20px;
        font-weight: 700;
        margin: 0;
    }

    .breadcrumb-parent {
        color: var(--ubs-dark-grey);
        font-weight: 600;
    }

    .breadcrumb-active {
        color: var(--ubs-blue);
        font-weight: 600;
    }

    /* ========================================
       2. DATA TABLE - CONTAINER & CONTROLS
       ======================================== */
    .table-container {
        background: #FFFFFF;
        border-radius: 12px;
        box-shadow: 0px 4px 4px -1px rgba(12, 12, 13, 0.1);
        display: flex;
        flex-direction: column;
    }

    .table-header {
        align-items: center;
        border-bottom: 1px solid var(--ubs-light-grey);
        display: flex;
        padding: 12px 20px;
    }

    .table-title {
        color: var(--ubs-blue);
        font-family: 'Public Sans', sans-serif;
        font-size: 20px;
        font-weight: 600;
        line-height: 24px;
        margin: 0;
    }

    .table-controls {
        align-items: center;
        display: flex;
        gap: 10px;
        justify-content: space-between;
        padding: 12px 20px;
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
        background: #FFFFFF;
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
        height: 34px;
        padding: 8px 12px;
        width: 179px;
    }

    /* ========================================
       3. DATA TABLE - STRUCTURE & CELLS
       ======================================== */
    .table-wrapper {
        overflow-x: auto;
    }

    .perbaikan-table {
        border-collapse: collapse;
        width: 100%;
    }

    .perbaikan-table thead {
        background: #F9FAFB;
        border-bottom: 1px solid #EAECF0;
    }

    .perbaikan-table thead th {
        color: #344054;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
        white-space: nowrap;
    }

    .perbaikan-table tbody tr {
        border-bottom: 1px solid #EAECF0;
        height: 188px;
    }

    .perbaikan-table tbody td {
        color: #344054;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        padding: 16px;
        vertical-align: top;
    }

    .perbaikan-table tbody tr:hover {
        background: #F9FAFB;
    }

    .bukti-image {
        border: 1px solid #EAECF0;
        border-radius: 8px;
        cursor: zoom-in;
        height: 150px;
        object-fit: cover;
        width: 150px;
    }

    .dokumen-image {
        border: 1px solid #EAECF0;
        border-radius: 8px;
        cursor: zoom-in;
        height: 100px;
        object-fit: cover;
        width: 100px;
    }

    .status-icon {
        align-items: flex-start;
        display: flex;
        justify-content: center;
    }

    /* ========================================
       4. ACTION BUTTONS
       ======================================== */
    .action-buttons {
        display: flex;
        gap: 6px;
    }

    .btn-action {
        align-items: center;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        display: flex;
        height: 36px;
        justify-content: center;
        padding: 9px;
        transition: all 0.2s ease;
        width: 36px;
    }

    .btn-action svg {
        height: 18px;
        width: 18px;
    }

    /* Upload Button */
    .btn-upload {
        background: var(--ubs-bright-blue);
        color: #FFFFFF;
    }

    .btn-upload:hover {
        background: var(--ubs-blue);
    }

    /* Send Button */
    .btn-send {
        background: #039855;
        color: #FFFFFF;
    }

    .btn-send:hover {
        background: #027A48;
    }

    /* Disabled States */
    .btn-action:disabled,
    .btn-action.disabled {
        cursor: not-allowed;
        opacity: 0.2;
        pointer-events: none;
    }

    /* ========================================
       5. MODALS - BASE & OVERLAY
       ======================================== */
    .modal-overlay {
        align-items: center;
        background: rgba(0, 0, 0, 0.5);
        display: none;
        height: 100%;
        justify-content: center;
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 9999;
    }

    .modal-overlay.active {
        display: flex;
    }

    /* ========================================
       6. MODALS - SEND MODAL
       ======================================== */
    .modal-send {
        background: #FFFFFF;
        border-radius: 12px;
        padding: 40px;
        text-align: center;
        width: 400px;
    }

    .modal-send-image {
        display: block;
        height: auto;
        margin: 0 auto 24px;
        width: 80px;
    }

    .modal-send-title {
        color: var(--ubs-dark-grey);
        font-family: 'Public Sans', sans-serif;
        font-size: 20px;
        font-weight: 700;
        margin: 0 0 24px 0;
    }

    .modal-send-buttons {
        display: flex;
        gap: 12px;
        justify-content: center;
    }

    .btn-modal {
        border-radius: 8px;
        cursor: pointer;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        padding: 10px 24px;
        transition: all 0.2s ease;
    }

    .btn-modal-cancel {
        background: transparent;
        border: 1px solid var(--ubs-bright-blue);
        color: var(--ubs-bright-blue);
    }

    .btn-modal-cancel:hover {
        background: rgba(32, 144, 224, 0.1);
    }

    .btn-modal-confirm {
        background: var(--ubs-bright-blue);
        border: none;
        color: #FFFFFF;
    }

    .btn-modal-confirm:hover {
        background: var(--ubs-blue);
    }

    /* ========================================
       7. MODALS - IMAGE ZOOM
       ======================================== */
    .modal-image-zoom {
        align-items: center;
        background: rgba(0, 0, 0, 0.9);
        cursor: zoom-out;
        display: none;
        height: 100%;
        justify-content: center;
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 10000;
    }

    .modal-image-zoom.active {
        display: flex;
    }

    .modal-image-zoom img {
        cursor: default;
        max-height: 90%;
        max-width: 90%;
        object-fit: contain;
    }

    .btn-close-image {
        align-items: center;
        background: #FFFFFF;
        border: none;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        height: 40px;
        justify-content: center;
        position: absolute;
        right: 30px;
        top: 20px;
        transition: all 0.2s ease;
        width: 40px;
    }

    .btn-close-image:hover {
        background: var(--ubs-light-grey);
    }

    .btn-close-image svg {
        height: 20px;
        width: 20px;
    }
</style>

<div class="perbaikan-container">
    <!-- ========== DATA TABLE ========== -->
    <div class="table-container">
        <div class="table-header">
            <h3 class="table-title">List Perbaikan</h3>
        </div>
        
        <div class="table-controls">
            <div class="entries-control">
                <span class="entries-label">Show</span>
                <select class="entries-select" id="entriesPerPage" onchange="handleEntriesChange()">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="25">25</option>
                    <option value="50">50</option>
                    <option value="100">100</option>
                </select>
                <span class="entries-label">entries</span>
            </div>
            
            <div class="search-control">
                <span class="search-label">Search:</span>
                <input type="text" class="search-input" id="searchInput" placeholder="" onkeyup="handleSearch()">
            </div>
        </div>
        
        <div class="table-wrapper">
            <table class="perbaikan-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bukti Inspeksi</th>
                        <th>Tgl Inspeksi</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Saran Perbaikan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                        <th>Dokumen</th>
                    </tr>
                </thead>
                <tbody id="perbaikanTableBody">
                    @foreach($improvements as $index => $item)
                    <tr data-id="{{ $item['id'] }}">
                        <td>{{ $index + 1 }}</td>
                        <td><img src="{{ $item['bukti_image'] }}" alt="Bukti" class="bukti-image" onclick="openImageZoom('{{ $item['bukti_image'] }}')"></td>
                        <td>{{ $item['tgl_inspeksi'] }}</td>
                        <td>{{ $item['lokasi'] }}</td>
                        <td>{{ $item['deskripsi'] }}</td>
                        <td>{{ $item['saran'] }}</td>
                        <td class="status-icon">
                            <span class="status-indicator" data-status="{{ $item['status'] }}">
                                @if($item['status'] === 'PENDING')
                                <svg width="11" height="24" viewBox="0 0 11 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 5.01C0 3.63 0.49 2.45 1.47 1.47C2.45 0.49 3.63 0 5.01 0C6.39 0 7.57 0.49 8.55 1.47C9.53 2.45 10.03 3.63 10.05 5.01C10.05 5.17 10.03 5.31 9.99 5.43L8.34 11.94C8.28 12.82 7.93 13.56 7.29 14.16C6.65 14.76 5.89 15.06 5.01 15.06C4.15 15.06 3.4 14.77 2.76 14.19C2.12 13.61 1.76 12.89 1.68 12.03C1.48 11.43 1.27 10.77 1.05 10.05C0.83 9.33 0.6 8.46 0.36 7.44C0.12 6.42 0 5.61 0 5.01ZM1.65 20.07C1.65 19.15 1.98 18.37 2.64 17.73C3.3 17.09 4.09 16.76 5.01 16.74C5.93 16.72 6.72 17.05 7.38 17.73C8.04 18.41 8.37 19.19 8.37 20.07C8.37 21.01 8.04 21.8 7.38 22.44C6.72 23.08 5.93 23.41 5.01 23.43C4.09 23.45 3.3 23.12 2.64 22.44C1.98 21.76 1.65 20.97 1.65 20.07Z" fill="#F04438"/>
                                </svg>
                                @elseif($item['status'] === 'SENT')
                                <svg width="11" height="24" viewBox="0 0 11 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 5.01C0 3.63 0.49 2.45 1.47 1.47C2.45 0.49 3.63 0 5.01 0C6.39 0 7.57 0.49 8.55 1.47C9.53 2.45 10.03 3.63 10.05 5.01C10.05 5.17 10.03 5.31 9.99 5.43L8.34 11.94C8.28 12.82 7.93 13.56 7.29 14.16C6.65 14.76 5.89 15.06 5.01 15.06C4.15 15.06 3.4 14.77 2.76 14.19C2.12 13.61 1.76 12.89 1.68 12.03C1.48 11.43 1.27 10.77 1.05 10.05C0.83 9.33 0.6 8.46 0.36 7.44C0.12 6.42 0 5.61 0 5.01ZM1.65 20.07C1.65 19.15 1.98 18.37 2.64 17.73C3.3 17.09 4.09 16.76 5.01 16.74C5.93 16.72 6.72 17.05 7.38 17.73C8.04 18.41 8.37 19.19 8.37 20.07C8.37 21.01 8.04 21.8 7.38 22.44C6.72 23.08 5.93 23.41 5.01 23.43C4.09 23.45 3.3 23.12 2.64 22.44C1.98 21.76 1.65 20.97 1.65 20.07Z" fill="#F79009"/>
                                </svg>
                                @else
                                -
                                @endif
                            </span>
                        </td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn-action btn-upload" onclick="uploadDocument({{ $item['id'] }})" {{ $item['status'] === 'SENT' ? 'disabled' : '' }}>
                                    <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M10 0H2C0.9 0 0.0100002 0.9 0.0100002 2L0 18C0 19.1 0.89 20 1.99 20H14C15.1 20 16 19.1 16 18V6L10 0ZM14 18H2V2H9V7H14V18ZM4 13.01L5.41 14.42L7 12.84V17H9V12.84L10.59 14.43L12 13.01L8.01 9L4 13.01Z" fill="white"/>
                                    </svg>
                                </button>
                                <button class="btn-action btn-send" onclick="openSendModal({{ $item['id'] }})" {{ $item['status'] === 'SENT' ? 'disabled' : '' }}>
                                    <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M1.5075 2.2725L7.14 4.6875L1.5 3.9375L1.5075 2.2725ZM7.1325 8.8125L1.5 11.2275V9.5625L7.1325 8.8125ZM0.00749999 0L0 5.25L11.25 6.75L0 8.25L0.00749999 13.5L15.75 6.75L0.00749999 0Z" fill="white"/>
                                    </svg>
                                </button>
                            </div>
                        </td>
                        <td><img src="{{ $item['dokumen_image'] }}" alt="Dokumen" class="dokumen-image" onclick="openImageZoom('{{ $item['dokumen_image'] }}')"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- ========== SEND MODAL ========== -->
<div id="modal-send" class="modal-overlay">
    <div class="modal-send">
        <img src="{{ asset('img/plane-send-illustration.png') }}" alt="Send" class="modal-send-image">
        <h3 class="modal-send-title">Apakah Anda yakin?</h3>
        <div class="modal-send-buttons">
            <button class="btn-modal btn-modal-cancel" onclick="closeSendModal()">Batal</button>
            <button class="btn-modal btn-modal-confirm" onclick="confirmSend()">Ya, Kirim</button>
        </div>
    </div>
</div>

<!-- ========== IMAGE ZOOM MODAL ========== -->
<div class="modal-image-zoom" id="imageZoomModal" onclick="closeImageZoom()">
    <button class="btn-close-image" onclick="closeImageZoom()">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18 6L6 18M6 6L18 18" stroke="#f94144" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    </button>
    <img id="zoomedImage" src="" alt="Zoomed Image">
</div>

<script>
    // ========== GLOBAL STATE ==========
    let currentImprovementId = null;
    let allRows = [];
    let filteredRows = [];
    let currentEntriesPerPage = 5;

    // ========== INITIALIZATION ==========
    window.addEventListener('DOMContentLoaded', function() {
        const tbody = document.getElementById('perbaikanTableBody');
        allRows = Array.from(tbody.querySelectorAll('tr'));
        filteredRows = [...allRows];
        applyFilters();
    });

    // ========== FILTER FUNCTIONS ==========
    function handleSearch() {
        applyFilters();
    }

    function handleEntriesChange() {
        currentEntriesPerPage = parseInt(document.getElementById('entriesPerPage').value);
        applyFilters();
    }

    function applyFilters() {
        const searchQuery = document.getElementById('searchInput').value.toLowerCase();
        
        filteredRows = allRows.filter(row => {
            if (searchQuery !== '') {
                const rowText = Array.from(row.cells)
                    .map(cell => cell.textContent.toLowerCase())
                    .join(' ');
                if (!rowText.includes(searchQuery)) {
                    return false;
                }
            }
            return true;
        });
        
        displayFilteredRows();
    }

    function displayFilteredRows() {
        allRows.forEach(row => {
            row.style.display = 'none';
        });
        
        filteredRows.slice(0, currentEntriesPerPage).forEach(row => {
            row.style.display = '';
        });
    }

    // ========== MODAL FUNCTIONS: UPLOAD ==========
    function uploadDocument(id) {
        // TODO: Backend integration - implement document upload functionality
        console.log('Upload document for improvement ID:', id);
        alert('Upload dokumen akan diintegrasikan oleh backend developer');
    }

    // ========== MODAL FUNCTIONS: SEND ==========
    function openSendModal(id) {
        currentImprovementId = id;
        document.getElementById('modal-send').classList.add('active');
    }

    function closeSendModal() {
        document.getElementById('modal-send').classList.remove('active');
        currentImprovementId = null;
    }

    function confirmSend() {
        if (currentImprovementId) {
            const row = document.querySelector(`tr[data-id="${currentImprovementId}"]`);
            if (row) {
                const statusCell = row.querySelector('.status-indicator');
                statusCell.setAttribute('data-status', 'SENT');
                statusCell.innerHTML = `<svg width="11" height="24" viewBox="0 0 11 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 5.01C0 3.63 0.49 2.45 1.47 1.47C2.45 0.49 3.63 0 5.01 0C6.39 0 7.57 0.49 8.55 1.47C9.53 2.45 10.03 3.63 10.05 5.01C10.05 5.17 10.03 5.31 9.99 5.43L8.34 11.94C8.28 12.82 7.93 13.56 7.29 14.16C6.65 14.76 5.89 15.06 5.01 15.06C4.15 15.06 3.4 14.77 2.76 14.19C2.12 13.61 1.76 12.89 1.68 12.03C1.48 11.43 1.27 10.77 1.05 10.05C0.83 9.33 0.6 8.46 0.36 7.44C0.12 6.42 0 5.61 0 5.01ZM1.65 20.07C1.65 19.15 1.98 18.37 2.64 17.73C3.3 17.09 4.09 16.76 5.01 16.74C5.93 16.72 6.72 17.05 7.38 17.73C8.04 18.41 8.37 19.19 8.37 20.07C8.37 21.01 8.04 21.8 7.38 22.44C6.72 23.08 5.93 23.41 5.01 23.43C4.09 23.45 3.3 23.12 2.64 22.44C1.98 21.76 1.65 20.97 1.65 20.07Z" fill="#F79009"/>
                </svg>`;
                
                const actionButtons = row.querySelectorAll('.btn-action');
                actionButtons.forEach(button => {
                    button.disabled = true;
                    button.classList.add('disabled');
                });
            }
        }
        closeSendModal();
    }

    // ========== MODAL FUNCTIONS: IMAGE ZOOM ==========
    function openImageZoom(imageSrc) {
        document.getElementById('zoomedImage').src = imageSrc;
        document.getElementById('imageZoomModal').classList.add('active');
    }

    function closeImageZoom() {
        document.getElementById('imageZoomModal').classList.remove('active');
    }

    // ========== EVENT LISTENERS ==========
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
                currentImprovementId = null;
            }
        });
    });
</script>
@endsection
