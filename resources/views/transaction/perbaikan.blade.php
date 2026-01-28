@php
    // Data akan diambil dari API via JavaScript
@endphp

@extends('layouts.dashboard')

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
        height: 150px;
        object-fit: cover;
        width: 150px;
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
       7. MODALS - EDIT/UPLOAD MODAL
       ======================================== */
    .modal-edit {
        background: var(--ubs-background-grey);
        border-radius: 9.6px;
        display: flex;
        flex-direction: column;
        gap: 16px;
        max-height: 90vh;
        overflow-y: auto;
        padding: 19.2px 16px;
        width: 689.6px;
    }

    .modal-edit-header {
        align-items: center;
        border-bottom: 0.8px solid #9A9A9A;
        display: flex;
        justify-content: space-between;
        padding: 0 0 12.8px 0;
    }

    .modal-edit-title {
        color: var(--ubs-blue);
        font-family: 'Public Sans', sans-serif;
        font-size: 20px;
        font-weight: 700;
        line-height: 24px;
        margin: 0;
    }

    .btn-close {
        align-items: center;
        background: transparent;
        border: none;
        cursor: pointer;
        display: flex;
        height: 22.4px;
        justify-content: center;
        padding: 0;
        width: 22.4px;
    }

    .btn-close svg {
        height: 100%;
        width: 100%;
    }

    .btn-close:hover svg path {
        stroke: var(--ubs-dark-grey);
    }

    .modal-edit-body {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .modal-edit-image-section {
        align-items: center;
        display: flex;
        flex-direction: column;
        gap: 10px;
        justify-content: flex-end;
    }

    .modal-edit-image {
        border-radius: 8px;
        height: 200px;
        object-fit: cover;
        width: 200px;
    }

    .btn-upload-image {
        align-items: center;
        background: #0B4A6F;
        border: none;
        border-radius: 6px;
        box-shadow: 0px 0.8px 6.4px rgba(16, 24, 40, 0.16);
        color: #FFFFFF;
        cursor: pointer;
        display: flex;
        font-family: 'Public Sans', sans-serif;
        font-size: 11.2px;
        font-weight: 600;
        gap: 6.4px;
        height: 36px;
        justify-content: center;
        line-height: 13px;
        padding: 6.4px 12.8px;
        width: auto;
    }

    .btn-upload-image:hover {
        opacity: 0.9;
    }

    .modal-edit-footer {
        border-top: 1px solid #9A9A9A;
        display: flex;
        gap: 12.8px;
        justify-content: flex-end;
        padding: 12px 0 0 0;
    }

    .modal-edit-footer .btn-modal-cancel {
        align-items: center;
        background: #F6FEF9;
        border: 0.8px solid #0B4A6F;
        border-radius: 6.4px;
        box-shadow: 0px 0.8px 6.4px rgba(16, 24, 40, 0.16), 0px 4px 8px 2px rgba(56, 56, 56, 0.1);
        box-sizing: border-box;
        color: #0B4A6F;
        cursor: pointer;
        display: flex;
        font-family: 'Public Sans', sans-serif;
        font-size: 11.2px;
        font-weight: 600;
        gap: 6.4px;
        height: 36.8px;
        justify-content: center;
        line-height: 13px;
        padding: 6.4px 12.8px;
        width: 100px;
    }

    .modal-edit-footer .btn-modal-cancel:hover {
        opacity: 0.9;
    }

    .btn-save {
        align-items: center;
        background: #0B4A6F;
        border: none;
        border-radius: 6px;
        box-shadow: 0px 0.8px 6.4px rgba(16, 24, 40, 0.16), 0px 4px 8px 2px rgba(56, 56, 56, 0.1);
        color: #FFFFFF;
        cursor: pointer;
        display: flex;
        font-family: 'Public Sans', sans-serif;
        font-size: 11.2px;
        font-weight: 600;
        gap: 6.4px;
        height: 36.8px;
        justify-content: center;
        line-height: 13px;
        padding: 6.4px 12.8px;
        width: 100px;
    }

    .btn-save:hover {
        opacity: 0.9;
    }

    /* ========================================
       8. MODALS - IMAGE ZOOM
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

    /* ========================================
       9. TABLE FOOTER & PAGINATION
       ======================================== */
    .table-footer {
        align-items: center;
        border-top: 1px solid var(--ubs-light-grey);
        display: flex;
        justify-content: space-between;
        padding: 12px 20px;
    }

    .footer-info {
        color: var(--ubs-dark-grey);
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        font-weight: 500;
    }

    .pagination {
        display: flex;
        gap: 8px;
    }

    .pagination-btn {
        align-items: center;
        background: #FFFFFF;
        border: 1px solid var(--ubs-light-grey);
        border-radius: 6px;
        color: var(--ubs-dark-grey);
        cursor: pointer;
        display: flex;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        font-weight: 500;
        gap: 6px;
        height: 36px;
        justify-content: center;
        padding: 8px 16px;
        transition: all 0.2s ease;
    }

    .pagination-btn:hover:not(:disabled) {
        background: var(--ubs-light-grey);
        border-color: var(--ubs-dark-grey);
    }

    .pagination-btn:disabled {
        cursor: not-allowed;
        opacity: 0.5;
    }

    /* ========================================
       9. STATUS STYLES
       ======================================== */
    .status-open {
        color: #F04438;
    }

    .status-progress {
        color: #F79009;
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
                    <!-- Data akan diisi oleh JavaScript dari API -->
                </tbody>
            </table>
        </div>

        <!-- Table Footer -->
        <div class="table-footer">
            <div class="footer-info" id="footerInfo">
                Showing 0 to 0 of 0 entries
            </div>
            <div class="pagination">
                <button class="pagination-btn" id="prevBtn" onclick="previousPage()">
                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M6.5 0L8 1.5L3.5 6L8 10.5L6.5 12L0.5 6L6.5 0Z" fill="#667085"/>
                    </svg>
                </button>
                <button class="pagination-btn" id="nextBtn" onclick="nextPage()">
                    <svg width="8" height="12" viewBox="0 0 8 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 0L0 1.5L4.5 6L0 10.5L1.5 12L7.5 6L1.5 0Z" fill="#667085"/>
                    </svg>
                </button>
            </div>
        </div>
    </div>
</div>

<!-- ========== UPLOAD MODAL ========== -->
<div id="modal-upload" class="modal-overlay">
    <div class="modal-edit">
        <div class="modal-edit-header">
            <h3 class="modal-edit-title">Upload Bukti Perbaikan</h3>
            <button class="btn-close" onclick="closeUploadModal()">
                <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M16.5 5.5L5.5 16.5M5.5 5.5L16.5 16.5" stroke="#000000" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="modal-edit-body">
            <div class="modal-edit-image-section">
                <img id="uploadPreviewImage" src="" alt="Bukti Perbaikan" class="modal-edit-image">
                <input type="file" id="fileUploadInput" style="display: none;" accept="image/*">
                <button class="btn-upload-image" onclick="selectUploadFile()">Upload Gambar Baru</button>
            </div>
        </div>
        <div class="modal-edit-footer">
            <button class="btn-modal-cancel" onclick="closeUploadModal()">Batal</button>
            <button class="btn-save" onclick="saveUploadedFile()">Simpan</button>
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
    let currentPage = 1;
    let totalRecords = 0;
    let improvementsData = [];
    let uploadedFile = null;

    // ========== API FUNCTIONS ==========
    async function loadImprovements() {
        try {
            const response = await fetch('/api/transaksi-perbaikan?per_page=100', {
                headers: {
                    'Content-Type': 'application/json',
                }
            });
            
            if (!response.ok) {
                if (response.status === 401) {
                    alert('Session expired, please login again');
                    window.location.href = '/login';
                    return;
                }
                throw new Error('Failed to load data');
            }
            const data = await response.json();
            
            // Filter hanya status 'Open' atau null (belum closed), bukan yang punya tgl_perbaikan (sudah closed)
            improvementsData = data.data.filter(item => 
                (item.status === 'Open')
            );
            renderTable(improvementsData);
        } catch (error) {
            console.error('Error loading improvements:', error);
            alert('Gagal memuat data perbaikan: ' + error.message);
        }
    }

    function renderTable(data) {
        const tbody = document.getElementById('perbaikanTableBody');
        tbody.innerHTML = '';
        
        data.forEach((item, index) => {
            const row = document.createElement('tr');
            row.dataset.id = item.no_dokumen + ',' + item.sub;
            row.dataset.status = item.status;
            
            // Format tanggal
            const tanggal = item.inspect_h?.tanggal ? new Date(item.inspect_h.tanggal).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }) : '-';
            
            // Determine status color
            let statusSvg = '';
            let statusClass = '';
            if (item.tgl_perbaikan) {
                // Jika ada tgl_perbaikan, tampilkan orange (sedang dalam perbaikan)
                statusSvg = '<svg width="11" height="24" viewBox="0 0 11 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 5.01C0 3.63 0.49 2.45 1.47 1.47C2.45 0.49 3.63 0 5.01 0C6.39 0 7.57 0.49 8.55 1.47C9.53 2.45 10.03 3.63 10.05 5.01C10.05 5.17 10.03 5.31 9.99 5.43L8.34 11.94C8.28 12.82 7.93 13.56 7.29 14.16C6.65 14.76 5.89 15.06 5.01 15.06C4.15 15.06 3.4 14.77 2.76 14.19C2.12 13.61 1.76 12.89 1.68 12.03C1.48 11.43 1.27 10.77 1.05 10.05C0.83 9.33 0.6 8.46 0.36 7.44C0.12 6.42 0 5.61 0 5.01ZM1.65 20.07C1.65 19.15 1.98 18.37 2.64 17.73C3.3 17.09 4.09 16.76 5.01 16.74C5.93 16.72 6.72 17.05 7.38 17.73C8.04 18.41 8.37 19.19 8.37 20.07C8.37 21.01 8.04 21.8 7.38 22.44C6.72 23.08 5.93 23.41 5.01 23.43C4.09 23.45 3.3 23.12 2.64 22.44C1.98 21.76 1.65 20.97 1.65 20.07Z" fill="#F79009"/></svg>';
                statusClass = 'status-progress';
            } else if (item.status === 'Open') {
                // Default status Open (merah)
                statusSvg = '<svg width="11" height="24" viewBox="0 0 11 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 5.01C0 3.63 0.49 2.45 1.47 1.47C2.45 0.49 3.63 0 5.01 0C6.39 0 7.57 0.49 8.55 1.47C9.53 2.45 10.03 3.63 10.05 5.01C10.05 5.17 10.03 5.31 9.99 5.43L8.34 11.94C8.28 12.82 7.93 13.56 7.29 14.16C6.65 14.76 5.89 15.06 5.01 15.06C4.15 15.06 3.4 14.77 2.76 14.19C2.12 13.61 1.76 12.89 1.68 12.03C1.48 11.43 1.27 10.77 1.05 10.05C0.83 9.33 0.6 8.46 0.36 7.44C0.12 6.42 0 5.61 0 5.01ZM1.65 20.07C1.65 19.15 1.98 18.37 2.64 17.73C3.3 17.09 4.09 16.76 5.01 16.74C5.93 16.72 6.72 17.05 7.38 17.73C8.04 18.41 8.37 19.19 8.37 20.07C8.37 21.01 8.04 21.8 7.38 22.44C6.72 23.08 5.93 23.41 5.01 23.43C4.09 23.45 3.3 23.12 2.64 22.44C1.98 21.76 1.65 20.97 1.65 20.07Z" fill="#F04438"/></svg>';
                statusClass = 'status-open';
            }
            
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${item.bukti_temuan ? `<img src="/storage/bukti_temuan/${item.bukti_temuan}" alt="Bukti Temuan" class="bukti-image" onerror="this.style.display='none'" onclick="openImageZoom(this.src)" style="cursor: zoom-in;">` : '-'}</td>
                <td>${tanggal}</td>
                <td>${item.inspect_h?.lokasi?.nama_lokasi || '-'}</td>
                <td><div style="max-width: 200px; overflow: hidden; text-overflow: ellipsis;">${item.deskripsi || '-'}</div></td>
                <td><div class="saran-box"><strong>Koreksi:</strong><p>${item.saran_koreksi || '-'}</p><strong>Korektif:</strong><p>${item.saran_korektif || '-'}</p></div></td>
                <td class="status-icon">
                    <span class="status-indicator" data-status="${item.status}">
                        ${statusSvg}
                    </span>
                </td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action btn-upload" onclick="openUploadModal('${item.no_dokumen},${item.sub}')">
                            <svg width="16" height="20" viewBox="0 0 16 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 0H2C0.9 0 0.0100002 0.9 0.0100002 2L0 18C0 19.1 0.89 20 1.99 20H14C15.1 20 16 19.1 16 18V6L10 0ZM14 18H2V2H9V7H14V18ZM4 13.01L5.41 14.42L7 12.84V17H9V12.84L10.59 14.43L12 13.01L8.01 9L4 13.01Z" fill="white"/>
                            </svg>
                        </button>
                        <button class="btn-action btn-send" onclick="openSendModal('${item.no_dokumen},${item.sub}')">
                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5075 2.2725L7.14 4.6875L1.5 3.9375L1.5075 2.2725ZM7.1325 8.8125L1.5 11.2275V9.5625L7.1325 8.8125ZM0.00749999 0L0 5.25L11.25 6.75L0 8.25L0.00749999 13.5L15.75 6.75L0.00749999 0Z" fill="white"/>
                            </svg>
                        </button>
                    </div>
                </td>
                <td>${item.bukti_perbaikan ? `<img src="/storage/bukti_perbaikan/${item.bukti_perbaikan}" alt="Bukti Perbaikan" class="dokumen-image" onclick="openImageZoom(this.src)" style="cursor: zoom-in;">` : '-'}</td>
            `;
            
            tbody.appendChild(row);
        });
        
        allRows = Array.from(tbody.querySelectorAll('tr'));
        filteredRows = [...allRows];
        applyFilters();
    }

    // ========== INITIALIZATION ==========
    window.addEventListener('DOMContentLoaded', function() {
        loadImprovements();
    });

    // ========== FILTER FUNCTIONS ==========
    function handleSearch() {
        applyFilters();
    }

    function handleEntriesChange() {
        currentEntriesPerPage = parseInt(document.getElementById('entriesPerPage').value);
        currentPage = 1;
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
        allRows.forEach((row, idx) => {
            const start = (currentPage - 1) * currentEntriesPerPage;
            const end = start + currentEntriesPerPage;
            row.style.display = (idx >= start && idx < end) ? '' : 'none';
        });
        updatePagination();
    }

    // ========== PAGINATION FUNCTIONS ==========
    function updatePagination() {
        const from = (currentPage - 1) * currentEntriesPerPage + 1;
        const to = Math.min(currentPage * currentEntriesPerPage, filteredRows.length);
        const total = filteredRows.length;
        document.getElementById('footerInfo').innerHTML = 
            `Showing ${from} to ${to} of ${total} entries`;
        document.getElementById('prevBtn').disabled = currentPage === 1;
        document.getElementById('nextBtn').disabled = to === total;
    }

    function nextPage() {
        if (currentPage * currentEntriesPerPage < filteredRows.length) {
            currentPage++;
            displayFilteredRows();
        }
    }

    function previousPage() {
        if (currentPage > 1) {
            currentPage--;
            displayFilteredRows();
        }
    }

    // ========== MODAL FUNCTIONS: UPLOAD ==========
    function openUploadModal(id) {
        currentImprovementId = id;
        
        // Clear file input dan preview
        const fileInput = document.getElementById('fileUploadInput');
        if (fileInput) fileInput.value = '';
        document.getElementById('uploadPreviewImage').src = '';
        
        document.getElementById('modal-upload').classList.add('active');
    }

    function closeUploadModal() {
        document.getElementById('modal-upload').classList.remove('active');
        currentImprovementId = null;
        uploadedFile = null;
    }

    function selectUploadFile() {
        document.getElementById('fileUploadInput').click();
    }

    // Handle file selection
    document.getElementById('fileUploadInput')?.addEventListener('change', async function(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Preview image
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('uploadPreviewImage').src = event.target.result;
            uploadedFile = file;
        };
        reader.readAsDataURL(file);
    });

    async function saveUploadedFile() {
        if (!currentImprovementId || !uploadedFile) {
            alert('Silakan pilih file terlebih dahulu');
            return;
        }

        try {
            const [no_dokumen, sub] = currentImprovementId.split(',');
            
            // Upload file
            const formData = new FormData();
            formData.append('file', uploadedFile);
            formData.append('no_dokumen', no_dokumen);
            
            const uploadResponse = await fetch('/api/transaksi-perbaikan/upload', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: formData
            });
            
            if (!uploadResponse.ok) throw new Error('Failed to upload image');
            
            const uploadData = await uploadResponse.json();
            const buktiPerbaikanPath = uploadData.file_name;
            
            // Update record with bukti_perbaikan path
            const updateResponse = await fetch('/api/transaksi-perbaikan/' + currentImprovementId, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                },
                body: JSON.stringify({
                    bukti_perbaikan: buktiPerbaikanPath
                })
            });
            
            if (!updateResponse.ok) throw new Error('Failed to update');
            
            // Clear file input after successful save
            const fileInput = document.getElementById('fileUploadInput');
            if (fileInput) fileInput.value = '';
            
            await loadImprovements();
            alert('Bukti perbaikan berhasil diupload');
        } catch (error) {
            console.error('Error:', error);
            alert('Gagal upload bukti perbaikan');
        }
        
        closeUploadModal();
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

    async function confirmSend() {
        if (currentImprovementId) {
            try {
                const response = await fetch('/api/transaksi-perbaikan/' + currentImprovementId, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                });
                
                if (!response.ok) throw new Error('Failed to update');
                
                await loadImprovements();
                alert('Data perbaikan berhasil dikirim');
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal mengirim data perbaikan');
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
                uploadedFile = null;
            }
        });
    });
</script>
@endsection
