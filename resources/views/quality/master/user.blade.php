@extends('layouts.dashboard')

@section('page-title')
<h1 class="page-title-header">Master / User</h1>
@endsection

@section('content')
<style>
    /* ========== MASTER USER PAGE STYLES ========== */
    
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
    
    /* Tambah User Button */
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
    
    .form-group {
        margin-bottom: 16px;
    }
    
    .form-label {
        display: block;
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 14px;
        color: #344054;
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
        font-size: 14px;
        color: #344054;
        transition: all 0.2s ease;
    }
    
    .form-input:focus {
        background: #FFFFFF;
        border-color: #0B4A6F;
        outline: none;
    }
    
    .form-input:read-only {
        background: #F2F4F7;
        cursor: not-allowed;
    }
    
    .form-select {
        width: 100%;
        height: 46px;
        padding: 0 14px;
        background: #EAECF0;
        border: 1px solid #B5B5B5;
        border-radius: 8px;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        color: #344054;
        transition: all 0.2s ease;
    }
    
    .form-select:focus {
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
    
    /* Lookup Input with Search Button */
    .lookup-group {
        display: flex;
        gap: 8px;
    }
    
    .lookup-input {
        flex: 1;
    }
    
    .btn-search {
        width: 46px;
        height: 46px;
        background: #0B4A6F;
        border: none;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: background 0.2s ease;
        flex-shrink: 0;
    }
    
    .btn-search:hover {
        background: #094161;
    }
    
    /* ========== DELETE MODAL STYLES ========== */
    
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
    
    .btn-delete-cancel {
        background: #FFFFFF;
        border: 0.84px solid #0B4A6F;
        box-shadow: 0px 0.84px 6.7px rgba(16, 24, 40, 0.16);
        color: #0B4A6F;
    }
    
    .btn-delete-confirm {
        background: #0B4A6F;
        border: 0.84px solid #0B4A6F;
        box-shadow: 0px 0.84px 6.7px rgba(16, 24, 40, 0.16);
        border-radius: 3.35px;
        color: #F6FEF9;
    }
    
    /* ========== LOOKUP POPUP STYLES ========== */
    
    /* Lookup popup needs higher z-index than main modal */
    #lookupPopupModal.modal-overlay {
        z-index: 10000 !important;
    }
    
    .lookup-popup-window {
        width: 468px;
        height: 359px;
        background: #FFFFFF;
        border-radius: 9.6px;
        box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.15);
        overflow: hidden;
        display: flex;
        flex-direction: column;
    }
    
    .lookup-popup-header {
        padding: 16px;
        border-bottom: 1px solid #E5E7EB;
        display: flex;
        gap: 8px;
        align-items: center;
    }
    
    .lookup-search-input {
        width: 197.6px;
        height: 32px;
        padding: 0 12px;
        background: #FFFFFF;
        border: 1px solid #D0D5DD;
        border-radius: 6px;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        color: #344054;
    }
    
    .lookup-search-input:focus {
        border-color: #0B4A6F;
        outline: none;
    }
    
    .btn-search-lookup {
        width: 93.4px;
        height: 32px;
        background: #0B4A6F;
        border: none;
        border-radius: 6px;
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 14px;
        color: #FFFFFF;
        cursor: pointer;
        transition: background 0.2s ease;
    }
    
    .btn-search-lookup:hover {
        background: #094161;
    }
    
    .lookup-popup-body {
        height: 279px;
        overflow-y: auto;
        border: 1px solid #E5E7EB;
        margin: 0 16px 16px 16px;
    }
    
    .lookup-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .lookup-table thead {
        position: sticky;
        top: 0;
        background: #F5FBFF;
        z-index: 1;
    }
    
    .lookup-table th {
        padding: 12px 16px;
        font-family: 'Public Sans', sans-serif;
        font-weight: 700;
        font-size: 14px;
        color: #344054;
        text-align: left;
        border-bottom: 1px solid #E5E7EB;
    }
    
    .lookup-table th:first-child {
        width: 128px;
    }
    
    .lookup-table th:last-child {
        width: 308px;
    }
    
    .lookup-table tbody tr {
        cursor: pointer;
        transition: background 0.2s ease;
    }
    
    .lookup-table tbody tr:hover {
        background: #F9FAFB;
    }
    
    .lookup-table td {
        padding: 12px 16px;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        color: #344054;
        border-bottom: 1px solid #F2F4F7;
    }
    
    /* Modal Window for User (800px wide) */
    .modal-window-user {
        width: 800px;
        background: #FFFFFF;
        border-radius: 9.6px;
        box-shadow: 0px 8px 24px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }
    
    /* Form Row for Four Inputs Side-by-Side */
    .form-row-four {
        display: flex;
        gap: 10px;
        margin-bottom: 16px;
    }
    
    .form-group-quarter {
        flex: 1;
        position: relative;
    }
    
    .form-input-quarter {
        width: 184.5px;
        height: 46px;
        padding: 0 40px 0 14px;
        background: #FFFFFF;
        border: 1px solid #B5B5B5;
        border-radius: 8px;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        color: #344054;
        cursor: pointer;
    }
    
    .form-input-quarter.readonly-gray {
        background: #EAECF0;
        cursor: not-allowed;
        padding: 0 14px;
    }
    
    .input-with-icon {
        position: relative;
    }
    
    .input-icon {
        position: absolute;
        right: 12px;
        top: 50%;
        transform: translateY(-50%);
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: all;
    }
    
    .input-icon:hover svg path {
        fill: #0B4A6F;
    }
</style>

<!-- Content Card -->
<div class="content-card">
    <!-- Table Header -->
    <div class="table-header">
        <h2 class="table-title">List User</h2>
        <button class="btn-tambah-role" onclick="openModal()">
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M10 0C4.489 0 0 4.489 0 10C0 15.511 4.489 20 10 20C15.511 20 20 15.511 20 10C20 4.489 15.511 0 10 0ZM10 2C14.4301 2 18 5.56988 18 10C18 14.4301 14.4301 18 10 18C5.56988 18 2 14.4301 2 10C2 5.56988 5.56988 2 10 2ZM9 5V9H5V11H9V15H11V11H15V9H11V5H9Z" fill="white"/>
            </svg>
            Tambah User
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
                <th>No Induk</th>
                <th>Nama</th>
                <th>Kode Role</th>
                <th>Kode Departemen</th>
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

<!-- Modal Lookup Employee Popup -->
<div id="lookupPopupModal" class="modal-overlay">
    <div class="lookup-popup-window">
        <div class="lookup-popup-header">
            <input type="text" id="lookupSearchInput" class="lookup-search-input" placeholder="Search">
            <button type="button" class="btn-search-lookup" onclick="performLookupSearch()">Search</button>
        </div>
        <div class="lookup-popup-body">
            <table class="lookup-table">
                <thead>
                    <tr>
                        <th>No Induk</th>
                        <th>Nama</th>
                    </tr>
                </thead>
                <tbody id="lookupTableBody">
                    <!-- Data will be loaded dynamically from API -->
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Create User -->
<div id="createUserModal" class="modal-overlay">
    <div class="modal-window-user">
        <div class="modal-header">
            <h3 class="modal-title">Tambah User</h3>
            <button class="modal-close" onclick="closeModal()">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.18944 11.2L0 10.0106L4.41056 5.6L0 1.18944L1.18944 0L5.6 4.41056L10.0106 0L11.2 1.18944L6.78944 5.6L11.2 10.0106L10.0106 11.2L5.6 6.78944L1.18944 11.2Z" fill="#737373"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <div class="form-row-four">
                    <div class="form-group-quarter">
                        <label class="form-label">No Induk</label>
                        <div class="input-with-icon">
                            <input type="text" id="userNoInduk" class="form-input-quarter" placeholder="No Induk" readonly onclick="openLookupPopup()">
                            <svg class="input-icon" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M10.0058 8.80502H9.37537L9.14925 8.58891C9.93372 7.6776 10.406 6.4917 10.406 5.20298C10.406 2.32934 8.07664 0 5.20298 0C2.32934 0 0 2.32934 0 5.20298C0 8.07664 2.32934 10.406 5.20298 10.406C6.4917 10.406 7.6776 9.93372 8.58891 9.14925L8.80502 9.37537V10.0058L12.8074 14L14 12.8074L10.0058 8.80502ZM5.20298 8.80502C3.20984 8.80502 1.60092 7.19611 1.60092 5.20298C1.60092 3.20984 3.20984 1.60092 5.20298 1.60092C7.19611 1.60092 8.80502 3.20984 8.80502 5.20298C8.80502 7.19611 7.19611 8.80502 5.20298 8.80502Z" fill="#0B4A6F"/>
                            </svg>
                        </div>
                    </div>
                    <div class="form-group-quarter">
                        <label class="form-label">Nama</label>
                        <input type="text" id="userNama" class="form-input-quarter readonly-gray" placeholder="Nama" readonly>
                    </div>
                    <div class="form-group-quarter">
                        <label class="form-label">Kode Role</label>
                        <input type="text" id="userKodeRole" class="form-input-quarter readonly-gray" placeholder="Kode Role" readonly>
                    </div>
                    <div class="form-group-quarter">
                        <label class="form-label">Kode Departemen</label>
                        <input type="text" id="userKodeDept" class="form-input-quarter readonly-gray" placeholder="Kode Departemen" readonly>
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeModal()">Cancel</button>
            <button class="btn-save" onclick="saveUser()">Save</button>
        </div>
    </div>
</div>

<!-- Modal Edit User (800px wide, 4-column layout) -->
<div id="editUserModal" class="modal-overlay">
    <div class="modal-window-user">
        <div class="modal-header">
            <h3 class="modal-title">Edit User</h3>
            <button class="modal-close" onclick="closeEditModal()">
                <svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.18944 11.2L0 10.0106L4.41056 5.6L0 1.18944L1.18944 0L5.6 4.41056L10.0106 0L11.2 1.18944L6.78944 5.6L11.2 10.0106L10.0106 11.2L5.6 6.78944L1.18944 11.2Z" fill="#737373"/>
                </svg>
            </button>
        </div>
        <div class="modal-body">
            <form>
                <input type="hidden" id="editUserId">
                <div class="form-row-four">
                    <div class="form-group-quarter">
                        <label class="form-label">No Induk</label>
                        <div class="input-with-icon">
                            <input type="text" id="editUserNoInduk" class="form-input-quarter" placeholder="No Induk" readonly onclick="openEditLookupPopup()">
                            <span class="input-icon" onclick="openEditLookupPopup()">
                                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M14.2939 12.5786H13.3905L13.0703 12.2699C14.191 10.9663 14.8656 9.27387 14.8656 7.43282C14.8656 3.32762 11.538 0 7.43282 0C3.32762 0 0 3.32762 0 7.43282C0 11.538 3.32762 14.8656 7.43282 14.8656C9.27387 14.8656 10.9663 14.191 12.2699 13.0703L12.5786 13.3905V14.2939L18.2962 20L20 18.2962L14.2939 12.5786ZM7.43282 12.5786C4.58548 12.5786 2.28702 10.2802 2.28702 7.43282C2.28702 4.58548 4.58548 2.28702 7.43282 2.28702C10.2802 2.28702 12.5786 4.58548 12.5786 7.43282C12.5786 10.2802 10.2802 12.5786 7.43282 12.5786Z" fill="#667085"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="form-group-quarter">
                        <label class="form-label">Nama</label>
                        <input type="text" id="editUserNama" class="form-input-quarter" placeholder="Nama">
                    </div>
                    <div class="form-group-quarter">
                        <label class="form-label">Kode Role</label>
                        <input type="text" id="editUserKodeRole" class="form-input-quarter" placeholder="Kode Role">
                    </div>
                    <div class="form-group-quarter">
                        <label class="form-label">Kode Dept</label>
                        <input type="text" id="editUserKodeDept" class="form-input-quarter" placeholder="Kode Dept">
                    </div>
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button class="btn-cancel" onclick="closeEditModal()">Cancel</button>
            <button class="btn-save" onclick="updateUser()">Save</button>
        </div>
    </div>
</div>

<!-- Modal Delete User -->
<div id="deleteModal" class="modal-delete-overlay">
    <div class="modal-delete-window">
        <div class="delete-illustration"></div>
        <h3 class="delete-title">Hapus User?</h3>
        <div class="delete-btn-wrapper">
            <button class="btn-delete-base btn-delete-cancel" onclick="closeDeleteModal()">Tidak</button>
            <button class="btn-delete-base btn-delete-confirm" onclick="confirmDelete()">Ya</button>
        </div>
    </div>
</div>

<script>
    // API Configuration
    const API_BASE = '/api/user';
    let currentPage = 1;
    let perPage = 5;
    let searchQuery = '';
    
    // ========== TABLE DATA LOADING ==========
    
    // Load data from API
    function loadUsers(page = 1) {
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
                console.error('Error loading users:', error);
                alert('Gagal memuat data user');
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
            emptyCell.colSpan = 7;
            emptyCell.style.textAlign = 'center';
            emptyCell.style.padding = '20px';
            emptyCell.textContent = 'Tidak ada data';
            emptyRow.appendChild(emptyCell);
            tbody.appendChild(emptyRow);
            return;
        }
        
        data.data.forEach((user, index) => {
            const row = document.createElement('tr');
            row.className = 'role-row';
            row.dataset.id = user.no_induk;
            
            const isActive = user.aktif === 'Y' || user.aktif === true;
            
            // Column 1: Index
            const tdIndex = document.createElement('td');
            tdIndex.textContent = (data.from || 0) + index;
            row.appendChild(tdIndex);
            
            // Column 2: No Induk
            const tdNoInduk = document.createElement('td');
            tdNoInduk.textContent = user.no_induk;
            row.appendChild(tdNoInduk);
            
            // Column 3: Nama
            const tdNama = document.createElement('td');
            tdNama.textContent = user.nama;
            row.appendChild(tdNama);
            
            // Column 4: Kode Role
            const tdKodeRole = document.createElement('td');
            tdKodeRole.textContent = user.kode_role || '-';
            row.appendChild(tdKodeRole);
            
            // Column 5: Kode Dept
            const tdKodeDept = document.createElement('td');
            tdKodeDept.textContent = user.kode_dept || '-';
            row.appendChild(tdKodeDept);
            
            // Column 6: Status Toggle
            const tdStatus = document.createElement('td');
            const toggleDiv = document.createElement('div');
            toggleDiv.className = `toggle-switch ${isActive ? 'active' : ''}`;
            toggleDiv.dataset.status = user.aktif;
            toggleDiv.dataset.userId = user.no_induk;
            toggleDiv.onclick = function() {
                toggleStatus(this, user.no_induk);
            };
            
            const toggleKnob = document.createElement('div');
            toggleKnob.className = 'toggle-switch-knob';
            toggleDiv.appendChild(toggleKnob);
            tdStatus.appendChild(toggleDiv);
            row.appendChild(tdStatus);
            
            // Column 7: Action Icons
            const tdAction = document.createElement('td');
            const actionIcons = document.createElement('div');
            actionIcons.className = 'action-icons';
            
            // Edit Icon
            const editSpan = document.createElement('span');
            editSpan.className = 'action-icon';
            editSpan.title = 'Edit';
            editSpan.onclick = function() {
                openEditModal(user.no_induk, user.no_induk, user.nama, user.kode_role, user.kode_dept);
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
                openDeleteModal(user.no_induk, user.nama);
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
        loadUsers(currentPage);
    }
    
    function nextPage() {
        loadUsers(currentPage + 1);
    }
    
    function previousPage() {
        if (currentPage > 1) {
            loadUsers(currentPage - 1);
        }
    }
    
    // ========== SEARCH FUNCTION ==========
    
    function handleSearch() {
        searchQuery = document.getElementById('searchInput').value.toLowerCase();
        currentPage = 1;
        loadUsers(currentPage);
    }
    
    // ========== MODAL FUNCTIONS ==========
    
    let editingUserId = null;
    
    function openModal() {
        editingUserId = null;
        document.getElementById('userNoInduk').value = '';
        document.getElementById('userNama').value = '';
        document.getElementById('userKodeRole').value = '';
        document.getElementById('userKodeDept').value = '';
        document.getElementById('createUserModal').querySelector('.modal-title').textContent = 'Tambah User';
        document.getElementById('createUserModal').classList.add('active');
    }
    
    function closeModal() {
        document.getElementById('createUserModal').classList.remove('active');
        editingUserId = null;
    }
    
    function openEditModal(id, noInduk, nama, kodeRole, kodeDept) {
        editingUserId = id;
        document.getElementById('editUserId').value = id;
        document.getElementById('editUserNoInduk').value = noInduk;
        document.getElementById('editUserNama').value = nama;
        document.getElementById('editUserKodeRole').value = kodeRole || '';
        document.getElementById('editUserKodeDept').value = kodeDept || '';
        document.getElementById('editUserModal').classList.add('active');
    }

    function closeEditModal() {
        document.getElementById('editUserModal').classList.remove('active');
        editingUserId = null;
    }

    function saveUser() {
        alert('Fitur tambah user belum diimplementasikan');
        closeModal();
    }

    function updateUser() {
        const id = document.getElementById('editUserId').value;
        const nama = document.getElementById('editUserNama').value.trim();
        const kodeRole = document.getElementById('editUserKodeRole').value.trim();
        const kodeDept = document.getElementById('editUserKodeDept').value.trim();
        
        if (!nama) {
            alert('Nama user harus diisi');
            return;
        }
        
        const payload = {
            nama: nama
        };
        
        if (kodeRole) payload.kode_role = kodeRole;
        if (kodeDept) payload.kode_dept = kodeDept;
        
        fetch(`${API_BASE}/${id}`, {
            method: 'PUT',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify(payload)
        })
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            alert('User berhasil diperbarui');
            closeEditModal();
            loadUsers(currentPage);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memperbarui user');
        });
    }

    // ========== LOOKUP POPUP FUNCTIONS ==========
    
    function openLookupPopup() {
        document.getElementById('lookupPopupModal').classList.add('active');
        loadLookupData();
    }

    function closeLookupPopup() {
        document.getElementById('lookupPopupModal').classList.remove('active');
        document.getElementById('lookupSearchInput').value = '';
    }

    function loadLookupData() {
        fetch(`${API_BASE}?per_page=100`)
            .then(response => response.json())
            .then(data => {
                renderLookupTable(data.data || []);
            })
            .catch(error => {
                console.error('Error loading lookup data:', error);
            });
    }

    function renderLookupTable(data) {
        const tbody = document.getElementById('lookupTableBody');
        
        // Clear existing rows
        while (tbody.firstChild) {
            tbody.removeChild(tbody.firstChild);
        }
        
        data.forEach(user => {
            const row = document.createElement('tr');
            row.onclick = function() {
                selectEmployee(user.no_induk, user.nama, user.kode_role, user.kode_dept);
            };
            
            const tdNoInduk = document.createElement('td');
            tdNoInduk.textContent = user.no_induk;
            row.appendChild(tdNoInduk);
            
            const tdNama = document.createElement('td');
            tdNama.textContent = user.nama;
            row.appendChild(tdNama);
            
            tbody.appendChild(row);
        });
    }

    function performLookupSearch() {
        const searchValue = document.getElementById('lookupSearchInput').value.toLowerCase();
        const rows = document.querySelectorAll('#lookupTableBody tr');
        
        rows.forEach(row => {
            const noInduk = row.cells[0].textContent.toLowerCase();
            const nama = row.cells[1].textContent.toLowerCase();
            
            if (noInduk.includes(searchValue) || nama.includes(searchValue)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        });
    }

    function selectEmployee(noInduk, nama, kodeRole, kodeDept) {
        document.getElementById('userNoInduk').value = noInduk;
        document.getElementById('userNama').value = nama;
        document.getElementById('userKodeRole').value = kodeRole || '';
        document.getElementById('userKodeDept').value = kodeDept || '';
        
        closeLookupPopup();
    }

    // ========== TOGGLE STATUS FUNCTION ==========
    
    function toggleStatus(element, userId) {
        const currentStatus = element.dataset.status;
        const newStatus = currentStatus === 'Y' || currentStatus === true ? 'N' : 'Y';
        
        fetch(`${API_BASE}/${userId}`, {
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
            alert('Gagal mengubah status user');
            // Revert toggle on error
            element.classList.toggle('active');
        });
    }

    // ========== DELETE MODAL FUNCTIONS ==========
    
    let userToDelete = null;
    let userNameToDelete = null;
    
    function openDeleteModal(userId, userName) {
        userToDelete = userId;
        userNameToDelete = userName;
        document.getElementById('deleteModal').classList.add('active');
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.remove('active');
        userToDelete = null;
        userNameToDelete = null;
    }
    
    function confirmDelete() {
        if (userToDelete) {
            fetch(`${API_BASE}/${userToDelete}`, {
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
                alert(`User "${userNameToDelete}" berhasil dihapus`);
                closeDeleteModal();
                loadUsers(currentPage);
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Gagal menghapus user');
            });
        }
    }
    
    // ========== EVENT LISTENERS & INITIALIZATION ==========
    
    // Close modals when clicking outside
    document.getElementById('createUserModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });
    
    document.getElementById('editUserModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeEditModal();
        }
    });
    
    document.getElementById('deleteModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeDeleteModal();
        }
    });
    
    document.getElementById('lookupPopupModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeLookupPopup();
        }
    });
    
    // Load initial data
    document.addEventListener('DOMContentLoaded', function() {
        loadUsers(currentPage);
    });
</script>

@endsection
