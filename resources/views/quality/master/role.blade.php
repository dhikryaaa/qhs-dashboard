@extends('layouts.dashboard')

@section('page-title')
<h1 class="page-title-header"><span class="breadcrumb-parent">Master</span> / <span class="breadcrumb-active">Role</span></h1>
@endsection

@section('content')
<style>
    /* ========== MASTER ROLE PAGE STYLES ========== */
    
    /* Override Floating Header to include page title */
    .floating-header-card {
        justify-content: space-between !important;
    }
    
    /* Page Title in Header */
    .page-title-header {
        font-family: 'Public Sans', sans-serif;
        font-style: normal;
        font-weight: 700;
        font-size: 20px;
        line-height: 24px;
        color: #98A2B3;
        margin: 0;
        width: auto;
        height: 24px;
        flex: none;
        order: 0;
        flex-grow: 0;
    }
    
    /* Content Card */
    .content-card {
        background: #FFFFFF;
        box-shadow: 0px 4px 4px -1px rgba(12, 12, 13, 0.1);
        border-radius: 12px;
        width: 100%;
    }
    
    /* Table Header Section */
    .table-header {
        height: 70px;
        border-bottom: 1px solid #D0D5DD;
        padding: 0 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .table-title {
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 20px;
        color: #0B4A6F;
        margin: 0;
    }
    
    /* Tambah Role Button */
    .btn-tambah-role {
        background: #0B4A6F;
        border-radius: 8px;
        padding: 8px 16px;
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 16px;
        color: #F6FEF9;
        border: none;
        display: flex;
        align-items: center;
        gap: 8px;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    
    .btn-tambah-role:hover {
        background: #094161;
    }
    
    /* Filter Bar */
    .filter-bar {
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #F2F4F7;
    }
    
    .filter-left {
        display: flex;
        align-items: center;
        gap: 8px;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        color: #344054;
    }
    
    .filter-left select {
        padding: 6px 12px;
        border: 1px solid #D0D5DD;
        border-radius: 6px;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        color: #344054;
        background: #FFFFFF;
    }
    
    .filter-right {
        display: flex;
        align-items: center;
        gap: 8px;
    }
    
    .search-label {
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        color: #344054;
    }
    
    .search-input {
        padding: 8px 12px;
        border: 1px solid #D0D5DD;
        border-radius: 6px;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        width: 200px;
        background: #FFFFFF;
    }
    
    /* Table Styles */
    .role-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .role-table thead tr {
        background: #F5FBFF;
        height: 59px;
    }
    
    .role-table th {
        padding: 12px 20px;
        font-family: 'Public Sans', sans-serif;
        font-weight: 700;
        font-size: 16px;
        color: #344054;
        text-align: left;
        border-bottom: 1px solid #E5E7EB;
    }
    
    .role-table tbody tr {
        height: 59px;
        border-bottom: 1px solid #F2F4F7;
    }
    
    .role-table tbody tr:hover {
        background: #F9FAFB;
    }
    
    .role-table td {
        padding: 12px 20px;
        font-family: 'Public Sans', sans-serif;
        font-weight: 400;
        font-size: 16px;
        color: #344054;
    }
    
    /* Status Badge */
    .status-badge {
        display: inline-block;
        padding: 4px 12px;
        border-radius: 16px;
        font-family: 'Public Sans', sans-serif;
        font-weight: 500;
        font-size: 14px;
    }
    
    .status-active {
        background: #D1FADF;
        color: #039855;
    }
    
    .status-inactive {
        background: #FEE4E2;
        color: #D92D20;
    }
    
    /* Toggle Switch */
    .toggle-switch {
        width: 42px;
        height: 24px;
        background: #D0D5DD;
        border-radius: 12px;
        position: relative;
        cursor: pointer;
        transition: background 0.3s ease;
        display: inline-block;
    }
    
    .toggle-switch.active {
        background: #039855;
    }
    
    .toggle-switch-knob {
        width: 18px;
        height: 18px;
        background: white;
        border-radius: 50%;
        position: absolute;
        top: 3px;
        left: 3px;
        transition: left 0.3s ease;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }
    
    .toggle-switch.active .toggle-switch-knob {
        left: 21px;
    }
    
    /* Action Icons */
    .action-icons {
        display: flex;
        gap: 12px;
    }
    
    .action-icon {
        cursor: pointer;
        transition: opacity 0.2s ease;
    }
    
    .action-icon:hover {
        opacity: 0.7;
    }
    
    /* Table Footer */
    .table-footer {
        padding: 16px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .footer-info {
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        color: #667085;
    }
    
    /* Pagination */
    .pagination {
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .pagination-btn {
        width: 32px;
        height: 32px;
        border: 1px solid #D0D5DD;
        border-radius: 6px;
        background: #FFFFFF;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .pagination-btn:hover {
        background: #F9FAFB;
        border-color: #0B4A6F;
    }
    
    .pagination-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }
    
    /* ========== MODAL STYLES ========== */
    
    /* Modal Overlay */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 9999;
        align-items: center;
        justify-content: center;
    }
    
    .modal-overlay.active {
        display: flex;
    }
    
    /* Modal Window */
    .modal-window {
        width: 600px;
        background: #FFFFFF;
        border-radius: 9.6px;
        box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }
    
    /* Modal Header */
    .modal-header {
        padding: 20px 16px;
        border-bottom: 1px solid #E5E7EB;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    
    .modal-title {
        font-family: 'Public Sans', sans-serif;
        font-weight: 700;
        font-size: 20px;
        color: #0B4A6F;
        margin: 0;
    }
    
    .modal-close {
        background: none;
        border: none;
        cursor: pointer;
        padding: 4px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: opacity 0.2s ease;
    }
    
    .modal-close:hover {
        opacity: 0.6;
    }
    
    /* Modal Body */
    .modal-body {
        padding: 20px 16px;
    }
    
    /* Form Row for 2-column layout */
    .form-row {
        display: flex;
        gap: 10px;
        margin-bottom: 16px;
    }
    
    .form-group {
        margin-bottom: 16px;
    }
    
    /* Half-width form group (279px) */
    .form-group-half {
        display: flex;
        flex-direction: column;
        gap: 8px;
        width: 279px;
        flex: 1;
    }
    
    .form-label {
        display: block;
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 16px;
        color: #1E1E1E;
        margin-bottom: 8px;
    }
    
    .form-input {
        width: 100%;
        height: 46px;
        padding: 0 14px;
        background: #EAECF0;
        border: 1px solid #B5B5B5;
        border-radius: 8px;
        font-family: 'Public Sans', sans-serif;
        font-size: 16px;
        color: #344054;
        transition: all 0.2s ease;
    }
    
    /* Half-width form input (279px) */
    .form-input-half {
        width: 100%;
        height: 46px;
        padding: 0 14px;
        background: #EAECF0;
        border: 1px solid #B5B5B5;
        border-radius: 8px;
        font-family: 'Public Sans', sans-serif;
        font-size: 16px;
        color: #667085;
        transition: all 0.2s ease;
    }
    
    .form-input:focus,
    .form-input-half:focus {
        background: #FFFFFF;
        border-color: #0B4A6F;
        outline: none;
    }
    
    /* Modal Footer */
    .modal-footer {
        background: #F9FAFB;
        border-top: 1px solid #9A9A9A;
        padding: 16px;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    
    .btn-cancel {
        padding: 10px 20px;
        background: #FFFFFF;
        border: 1px solid #D0D5DD;
        border-radius: 8px;
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 16px;
        color: #344054;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .btn-cancel:hover {
        background: #F9FAFB;
    }
    
    .btn-save {
        padding: 10px 20px;
        background: #0B4A6F;
        border: none;
        border-radius: 8px;
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 16px;
        color: #FFFFFF;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    
    .btn-save:hover {
        background: #094161;
    }
    
    /* ========== DELETE MODAL STYLES ========== */
    
    /* Delete Modal Overlay */
    .modal-delete-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        z-index: 10000;
        align-items: center;
        justify-content: center;
    }
    
    .modal-delete-overlay.active {
        display: flex;
    }
    
    /* Delete Modal Container */
    .modal-delete-window {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px;
        gap: 12px;
        width: 338px;
        height: 210.51px;
        background: #FCFCFD;
        box-shadow: 0px 0px 20px 5px rgba(20, 20, 20, 0.12);
        border-radius: 12px;
        position: relative;
    }
    
    /* The Illustration */
    .delete-illustration {
        width: 63.57px;
        height: 84px;
        background-image: url('{{ asset("img/trash-delete-illustration.png") }}');
        background-size: contain;
        background-repeat: no-repeat;
        background-position: center;
        flex: none;
        order: 0;
        flex-grow: 0;
    }
    
    /* Title Text "Hapus Role?" */
    .delete-title {
        width: 298px;
        height: 24px;
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 20px;
        line-height: 24px;
        text-align: center;
        color: #0B4A6F;
        flex: none;
        order: 1;
        align-self: stretch;
    }
    
    /* Button Wrapper */
    .delete-btn-wrapper {
        display: flex;
        flex-direction: row;
        align-items: flex-start;
        padding: 0px;
        gap: 13.39px;
        width: 298px;
        height: 38.51px;
        flex: none;
        order: 2;
    }
    
    /* Button Base Styles */
    .btn-delete-base {
        box-sizing: border-box;
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 6.69663px 13.3933px;
        gap: 6.7px;
        width: 142.3px;
        height: 38.51px;
        border-radius: 6.69663px;
        cursor: pointer;
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 11.72px;
        line-height: 14px;
        filter: drop-shadow(0px 0px 4px rgba(0, 0, 0, 0.02)) drop-shadow(0px 0px 8px rgba(0, 0, 0, 0.13));
        transition: opacity 0.2s ease;
    }
    
    .btn-delete-base:hover {
        opacity: 0.85;
    }
    
    /* "Tidak" Button (White) */
    .btn-delete-cancel {
        background: #FFFFFF;
        border: 0.84px solid #0B4A6F;
        box-shadow: 0px 0.84px 6.7px rgba(16, 24, 40, 0.16);
        color: #0B4A6F;
    }
    
    /* "Ya" Button (Blue) */
    .btn-delete-confirm {
        background: #0B4A6F;
        border: 0.84px solid #0B4A6F;
        box-shadow: 0px 0.84px 6.7px rgba(16, 24, 40, 0.16);
        border-radius: 3.35px;
        color: #F6FEF9;
    }
</style>

<!-- Content Card -->
<div class="content-card">
    <!-- Table Header -->
        <div class="table-header">
            <h2 class="table-title">List Role</h2>
            <button class="btn-tambah-role" onclick="openModal()">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10 0C4.489 0 0 4.489 0 10C0 15.511 4.489 20 10 20C15.511 20 20 15.511 20 10C20 4.489 15.511 0 10 0ZM10 2C14.4301 2 18 5.56988 18 10C18 14.4301 14.4301 18 10 18C5.56988 18 2 14.4301 2 10C2 5.56988 5.56988 2 10 2ZM9 5V9H5V11H9V15H11V11H15V9H11V5H9Z" fill="white"/>
                </svg>
                Tambah Role
            </button>
        </div>

        <!-- Filter Bar -->
        <div class="filter-bar">
            <div class="filter-left">
                <span>Show</span>
                <select id="entriesPerPage" onchange="handlePageChange()">
                    <option value="5" selected>5</option>
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="50">50</option>
                </select>
                <span>entries</span>
            </div>
            <div class="filter-right">
                <span class="search-label">Search:</span>
                <input type="text" id="searchInput" class="search-input" placeholder="" onkeyup="handleSearch()">
            </div>
        </div>

        <!-- Table -->
        <table class="role-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode Role</th>
                    <th>Nama Role</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody id="roleTableBody">
                <!-- Data will be loaded dynamically from API -->
            </tbody>
        </table>

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

<!-- Modal Tambah Role -->
<div id="createRoleModal" class="modal-overlay">
    <div class="modal-window">
        <!-- Modal Header -->
        <div class="modal-header">
            <h3 class="modal-title">Tambah Role</h3>
            <button class="modal-close" onclick="closeModal()">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.18944 11.2L0 10.0106L4.41056 5.6L0 1.18944L1.18944 0L5.6 4.41056L10.0106 0L11.2 1.18944L6.78944 5.6L11.2 10.0106L10.0106 11.2L5.6 6.78944L1.18944 11.2Z" fill="#737373"/>
                </svg>
            </button>
        </div>

        <!-- Modal Body -->
        <div class="modal-body">
            <form id="roleForm">
                <div class="form-row">
                    <div class="form-group-half">
                        <label class="form-label">Kode Role</label>
                        <input type="text" id="kodeRoleInput" class="form-input-half" placeholder="Masukkan kode role">
                    </div>
                    <div class="form-group-half">
                        <label class="form-label">Nama Role</label>
                        <input type="text" id="namaRoleInput" class="form-input-half" placeholder="Masukkan nama role">
                    </div>
                </div>
            </form>
        </div>

        <!-- Modal Footer -->
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeModal()">Cancel</button>
            <button class="btn-save" onclick="saveRole()">Save</button>
        </div>
    </div>
</div>

<!-- Modal Delete Role -->
<div id="deleteRoleModal" class="modal-delete-overlay">
    <div class="modal-delete-window">
        <!-- Illustration -->
        <div class="delete-illustration"></div>
        
        <!-- Title -->
        <h3 class="delete-title">Hapus Role?</h3>
        
        <!-- Buttons -->
        <div class="delete-btn-wrapper">
            <button class="btn-delete-base btn-delete-cancel" onclick="closeDeleteModal()">Tidak</button>
            <button class="btn-delete-base btn-delete-confirm" onclick="confirmDelete()">Ya</button>
        </div>
    </div>
</div>

<script>
    // API Configuration
    const API_BASE = '/api/role';
    let currentPage = 1;
    let perPage = 5;
    let searchQuery = '';
    
    // ========== TABLE DATA LOADING ==========
    
    // Load data from API
    function loadRoles(page = 1) {
        const params = new URLSearchParams({
            per_page: perPage,
            page: page,
            search: searchQuery
        });
        
        fetch(`${API_BASE}?${params}`)
            .then(response => response.json())
            .then(data => {
                renderTable(data);
                updatePagination(data);
            })
            .catch(error => {
                console.error('Error loading roles:', error);
                alert('Gagal memuat data role');
            });
    }
    
    // Render table rows using createElement
    function renderTable(data) {
        const tbody = document.getElementById('roleTableBody');
        
        // Clear existing rows
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        
        if (!data.data || data.data.length === 0) {
            const emptyRow = document.createElement('tr');
            const emptyCell = document.createElement('td');
            emptyCell.colSpan = 5;
            emptyCell.style.textAlign = 'center';
            emptyCell.style.padding = '20px';
            emptyCell.textContent = 'Tidak ada data';
            emptyRow.appendChild(emptyCell);
            tbody.appendChild(emptyRow);
            return;
        }
        
        data.data.forEach((role, index) => {
            const row = document.createElement('tr');
            row.className = 'role-row';
            row.dataset.id = role.kode_role;
            
            const isActive = role.aktif === 'Y' || role.aktif === true;
            
            // Column 1: Index
            const tdIndex = document.createElement('td');
            tdIndex.textContent = (data.from || 0) + index;
            row.appendChild(tdIndex);
            
            // Column 2: Kode Role
            const tdKode = document.createElement('td');
            tdKode.textContent = role.kode_role;
            row.appendChild(tdKode);
            
            // Column 3: Nama Role
            const tdNama = document.createElement('td');
            tdNama.textContent = role.nama;
            row.appendChild(tdNama);
            
            // Column 4: Status Toggle
            const tdStatus = document.createElement('td');
            const toggleDiv = document.createElement('div');
            toggleDiv.className = `toggle-switch ${isActive ? 'active' : ''}`;
            toggleDiv.dataset.status = role.aktif;
            toggleDiv.dataset.roleId = role.kode_role;
            toggleDiv.onclick = function() {
                toggleStatus(this, role.kode_role);
            };
            
            const toggleKnob = document.createElement('div');
            toggleKnob.className = 'toggle-switch-knob';
            toggleDiv.appendChild(toggleKnob);
            tdStatus.appendChild(toggleDiv);
            row.appendChild(tdStatus);
            
            // Column 5: Action Icons
            const tdAction = document.createElement('td');
            const actionIcons = document.createElement('div');
            actionIcons.className = 'action-icons';
            
            // Edit Icon
            const editSpan = document.createElement('span');
            editSpan.className = 'action-icon';
            editSpan.title = 'Edit';
            editSpan.onclick = function() {
                openEditModal(role.kode_role, role.kode_role, role.nama);
            };
            const editSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            editSvg.setAttribute('width', '18');
            editSvg.setAttribute('height', '18');
            editSvg.setAttribute('viewBox', '0 0 18 18');
            editSvg.setAttribute('fill', 'none');
            const editPath1 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            editPath1.setAttribute('d', 'M0 18.0024H3.75L14.81 6.94238L11.06 3.19238L0 14.2524V18.0024ZM2 15.0824L11.06 6.02238L11.98 6.94238L2.92 16.0024H2V15.0824Z');
            editPath1.setAttribute('fill', '#F79009');
            const editPath2 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            editPath2.setAttribute('d', 'M15.3699 0.2925C14.9799 -0.0975 14.3499 -0.0975 13.9599 0.2925L12.1299 2.1225L15.8799 5.8725L17.7099 4.0425C18.0999 3.6525 18.0999 3.0225 17.7099 2.6325L15.3699 0.2925Z');
            editPath2.setAttribute('fill', '#F79009');
            editSvg.appendChild(editPath1);
            editSvg.appendChild(editPath2);
            editSpan.appendChild(editSvg);
            actionIcons.appendChild(editSpan);
            
            // Delete Icon
            const deleteSpan = document.createElement('span');
            deleteSpan.className = 'action-icon';
            deleteSpan.title = 'Delete';
            deleteSpan.onclick = function() {
                openDeleteModal(role.kode_role, role.nama);
            };
            const deleteSvg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
            deleteSvg.setAttribute('width', '18');
            deleteSvg.setAttribute('height', '20');
            deleteSvg.setAttribute('viewBox', '0 0 18 20');
            deleteSvg.setAttribute('fill', 'none');
            const deletePath = document.createElementNS('http://www.w3.org/2000/svg', 'path');
            deletePath.setAttribute('d', 'M1 18C1 19.1 1.9 20 3 20H15C16.1 20 17 19.1 17 18V4H1V18ZM3 6H15V18H3V6ZM14.5 1L13.5 0H4.5L3.5 1H0V3H18V1H14.5Z');
            deletePath.setAttribute('fill', '#F04438');
            deleteSvg.appendChild(deletePath);
            deleteSpan.appendChild(deleteSvg);
            actionIcons.appendChild(deleteSpan);
            
            tdAction.appendChild(actionIcons);
            row.appendChild(tdAction);
            
            tbody.appendChild(row);
        });
    }
    
    // Update pagination info and buttons
    function updatePagination(data) {
        currentPage = data.current_page || 1;
        const total = data.total || 0;
        const from = data.from || 0;
        const to = data.to || 0;
        
        document.getElementById('footerInfo').textContent = 
            `Showing ${from} to ${to} of ${total} entries`;
        
        // Update pagination buttons
        document.getElementById('prevBtn').disabled = !data.prev_page_url;
        document.getElementById('nextBtn').disabled = !data.next_page_url;
    }
    
    // ========== PAGINATION FUNCTIONS ==========
    
    function handlePageChange() {
        perPage = parseInt(document.getElementById('entriesPerPage').value);
        currentPage = 1;
        loadRoles(currentPage);
    }
    
    function nextPage() {
        loadRoles(currentPage + 1);
    }
    
    function previousPage() {
        if (currentPage > 1) {
            loadRoles(currentPage - 1);
        }
    }
    
    // ========== SEARCH FUNCTION ==========
    
    function handleSearch() {
        searchQuery = document.getElementById('searchInput').value.toLowerCase();
        currentPage = 1;
        loadRoles(currentPage);
    }
    
    // ========== MODAL FUNCTIONS ==========
    
    let editingRoleId = null;
    
    function openModal() {
        editingRoleId = null;
        document.getElementById('roleForm').reset();
        document.getElementById('createRoleModal').querySelector('.modal-title').textContent = 'Tambah Role';
        document.getElementById('createRoleModal').classList.add('active');
    }
    
    function openEditModal(id, kode, nama) {
        editingRoleId = id;
        document.getElementById('kodeRoleInput').value = kode;
        document.getElementById('namaRoleInput').value = nama;
        document.getElementById('createRoleModal').querySelector('.modal-title').textContent = 'Edit Role';
        document.getElementById('createRoleModal').classList.add('active');
    }

    function closeModal() {
        document.getElementById('createRoleModal').classList.remove('active');
        editingRoleId = null;
    }

    function saveRole() {
        const kode = document.getElementById('kodeRoleInput').value.trim();
        const nama = document.getElementById('namaRoleInput').value.trim();
        
        if (!kode || !nama) {
            alert('Kode role dan nama role harus diisi');
            return;
        }
        
        if (editingRoleId) {
            // Update
            updateRole(editingRoleId, kode, nama);
        } else {
            // Create
            createRole(kode, nama);
        }
    }
    
    function createRole(kode, nama) {
        fetch(API_BASE, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                kode_role: kode,
                nama: nama,
                aktif: 'Y'
            })
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            alert('Role berhasil ditambahkan');
            closeModal();
            loadRoles(currentPage);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal menambahkan role');
        });
    }
    
    function updateRole(id, kode, nama) {
        fetch(`${API_BASE}/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                nama: nama
            })
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            alert('Role berhasil diperbarui');
            closeModal();
            loadRoles(currentPage);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui role');
        });
    }

    // ========== TOGGLE STATUS FUNCTION ==========
    
    function toggleStatus(element, roleId) {
        const currentStatus = element.dataset.status;
        const newStatus = currentStatus === 'Y' || currentStatus === true ? 'N' : 'Y';
        
        fetch(`${API_BASE}/${roleId}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({
                aktif: newStatus
            })
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            // Update UI
            element.dataset.status = newStatus;
            element.classList.toggle('active');
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal mengubah status role');
            // Revert toggle on error
            element.classList.toggle('active');
        });
    }

    // ========== DELETE MODAL FUNCTIONS ==========
    
    let roleToDelete = null;
    let roleNameToDelete = null;
    
    function openDeleteModal(roleId, roleName) {
        roleToDelete = roleId;
        roleNameToDelete = roleName;
        document.getElementById('deleteRoleModal').classList.add('active');
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteRoleModal').classList.remove('active');
        roleToDelete = null;
        roleNameToDelete = null;
    }
    
    function confirmDelete() {
        if (roleToDelete) {
            fetch(`${API_BASE}/${roleToDelete}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                }
            })
            .then(response => {
                if (!response.ok) throw new Error('Network response was not ok');
                return response.json();
            })
            .then(data => {
                alert(`Role "${roleNameToDelete}" berhasil dihapus`);
                closeDeleteModal();
                loadRoles(currentPage);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menghapus role');
            });
        }
    }
    
    // ========== EVENT LISTENERS & INITIALIZATION ==========
    
    // Close modals when clicking outside
    document.getElementById('createRoleModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    document.getElementById('deleteRoleModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
    
    // Load initial data
    document.addEventListener('DOMContentLoaded', function() {
        loadRoles(currentPage);
    });
</script>

@endsection