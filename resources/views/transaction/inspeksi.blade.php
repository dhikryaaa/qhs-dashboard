@extends('layouts.app')

@section('page-title')
<h1 class="page-title-header"><span class="breadcrumb-parent">Transaksi</span> / <span class="breadcrumb-active">Inspeksi</span></h1>
@endsection

@php
    $departments = \App\Models\QHSDepartemen::select('kode_dept', 'nama_dept')->get();
    $locations = \App\Models\QHSLokasi::select('kode_lokasi', 'nama_lokasi')->get();
@endphp

@section('content')
<style>
    /* ========================================
       1. LAYOUT & STRUCTURE
       ======================================== */
    .floating-header-card {
        justify-content: space-between !important;
    }

    .inspeksi-container {
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
       2. FILTER BAR
       ======================================== */
    .filter-bar {
        align-items: center;
        background: #FFFFFF;
        border-radius: 12px;
        box-shadow: 0px 4px 4px -1px rgba(12, 12, 13, 0.1);
        display: flex;
        gap: 12px;
        padding: 20px;
    }

    .filter-select {
        background: #FFFFFF;
        border: 1px solid #D0D5DD;
        border-radius: 8px;
        color: #344054;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        padding: 10px 12px;
        width: 200px;
    }

    .btn-filter {
        align-items: center;
        background: var(--ubs-blue);
        border: none;
        border-radius: 8px;
        color: var(--ubs-background-grey);
        cursor: pointer;
        display: flex;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        gap: 8px;
        padding: 10px 16px;
        transition: all 0.2s ease;
    }

    .btn-filter:hover {
        background: var(--ubs-bright-blue);
    }

    /* ========================================
       3. DATA TABLE - CONTAINER & CONTROLS
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
       4. DATA TABLE - STRUCTURE & CELLS
       ======================================== */
    .table-wrapper {
        overflow-x: auto;
    }

    .inspeksi-table {
        border-collapse: collapse;
        width: 100%;
    }

    .inspeksi-table thead {
        background: #F9FAFB;
        border-bottom: 1px solid #EAECF0;
    }

    .inspeksi-table thead th {
        color: #344054;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        font-weight: 600;
        padding: 12px 16px;
        text-align: left;
        white-space: nowrap;
    }

    .inspeksi-table tbody tr {
        border-bottom: 1px solid #EAECF0;
        height: 188px;
    }

    .inspeksi-table tbody td {
        color: #344054;
        font-family: 'Public Sans', sans-serif;
        font-size: 14px;
        padding: 16px;
        vertical-align: top;
    }

    .inspeksi-table tbody tr:hover {
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
       5. ACTION BUTTONS
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

    /* Edit Button */
    .btn-edit {
        background: var(--ubs-bright-blue);
        color: #FFFFFF;
    }

    .btn-edit:hover {
        background: var(--ubs-blue);
    }

    /* Delete Button */
    .btn-delete {
        background: var(--ubs-red);
        color: #FFFFFF;
    }

    .btn-delete:hover {
        background: #F04438;
    }

    /* Send Button */
    .btn-send {
        background: var(--ubs-green);
        color: #FFFFFF;
    }

    .btn-send:hover {
        background: #7FA85B;
    }

    /* Disabled States */
    .btn-action:disabled,
    .btn-action.disabled {
        cursor: not-allowed;
        opacity: 0.2;
        pointer-events: none;
    }

    /* ========================================
       6. MODALS - BASE & OVERLAY
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
       7. MODALS - SEND MODAL
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
        background: var(--ubs-bright-blue);
    }

    /* ========================================
       8. MODALS - DELETE MODAL
       ======================================== */
    .modal-delete {
        align-items: center;
        background: #FCFCFD;
        border-radius: 12px;
        box-shadow: 0px 0px 20px 5px rgba(20, 20, 20, 0.12);
        display: flex;
        flex-direction: column;
        gap: 12px;
        height: 210.51px;
        padding: 20px;
        position: relative;
        width: 338px;
    }

    .modal-delete-image {
        background-image: url('{{ asset("img/trash-delete-illustration.png") }}');
        background-position: center;
        background-repeat: no-repeat;
        background-size: contain;
        flex: none;
        flex-grow: 0;
        height: 84px;
        order: 0;
        width: 63.57px;
    }

    .modal-delete-title {
        align-self: stretch;
        color: #0B4A6F;
        flex: none;
        font-family: 'Public Sans', sans-serif;
        font-size: 20px;
        font-weight: 600;
        height: 24px;
        line-height: 24px;
        order: 1;
        text-align: center;
        width: 298px;
    }

    .modal-delete-buttons {
        align-items: flex-start;
        display: flex;
        flex: none;
        flex-direction: row;
        gap: 13.39px;
        height: 38.51px;
        order: 2;
        padding: 0px;
        width: 298px;
    }

    .btn-delete-base {
        align-items: center;
        border-radius: 6.69663px;
        box-sizing: border-box;
        cursor: pointer;
        display: flex;
        filter: drop-shadow(0px 0px 4px rgba(0, 0, 0, 0.02)) drop-shadow(0px 0px 8px rgba(0, 0, 0, 0.13));
        flex-direction: row;
        font-family: 'Public Sans', sans-serif;
        font-size: 11.72px;
        font-weight: 600;
        gap: 6.7px;
        height: 38.51px;
        justify-content: center;
        line-height: 14px;
        padding: 6.69663px 13.3933px;
        transition: opacity 0.2s ease;
        width: 142.3px;
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
        background: #F04438;
        border: none;
        box-shadow: 0px 0.84px 6.7px rgba(16, 24, 40, 0.16);
        color: #FCFCFD;
    }

    /* ========================================
       9. MODALS - EDIT MODAL
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
        border-radius: 0;
        height: 200px;
        object-fit: cover;
        width: 200px;
    }

    .btn-upload-image {
        align-items: center;
        background: #0B4A6F;
        border: none;
        border-radius: 3.2px;
        box-shadow: 0px 0.8px 6.4px rgba(16, 24, 40, 0.16);
        color: #FFFFFF;
        cursor: pointer;
        display: flex;
        font-family: 'Public Sans', sans-serif;
        font-size: 11.2px;
        font-weight: 600;
        gap: 6.4px;
        height: 25.8px;
        justify-content: center;
        line-height: 13px;
        padding: 6.4px 12.8px;
        width: 126.6px;
    }

    .btn-upload-image:hover {
        opacity: 0.9;
    }

    .form-row {
        display: flex;
        gap: 10px;
    }

    .form-group {
        display: flex;
        flex: 1;
        flex-direction: column;
        gap: 8px;
    }

    .form-group-full {
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-label {
        color: #1E1E1E;
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        font-weight: 600;
        line-height: 19px;
        margin: 0;
    }

    .form-input,
    .form-select {
        align-items: center;
        background: #FFFFFF;
        border: 1px solid #B5B5B5;
        border-radius: 8px;
        box-sizing: border-box;
        color: var(--ubs-dark-grey);
        display: flex;
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        font-weight: 400;
        height: 46px;
        line-height: 26px;
        padding: 10px 16px;
    }

    .form-input:focus,
    .form-select:focus {
        border-color: var(--ubs-blue);
        outline: none;
    }

    .form-textarea {
        background: #FFFFFF;
        border: 1px solid #B5B5B5;
        border-radius: 8px;
        box-sizing: border-box;
        color: var(--ubs-dark-grey);
        font-family: 'Inter', sans-serif;
        font-size: 16px;
        font-weight: 400;
        height: 100px;
        line-height: 19px;
        padding: 10px 16px;
        resize: vertical;
    }

    .form-textarea:focus {
        border-color: var(--ubs-blue);
        outline: none;
    }

    /* Saran Perbaikan Box */
    .saran-perbaikan-box {
        border: 1px solid #B5B5B5;
        border-radius: 8px;
        display: flex;
        overflow: hidden;
    }

    .saran-perbaikan-column {
        display: flex;
        flex: 1;
        flex-direction: column;
        gap: 8px;
        padding: 10px 16px;
    }

    .saran-perbaikan-column:not(:last-child) {
        border-right: 1px solid #B5B5B5;
    }

    .saran-perbaikan-column .form-label {
        margin: 0;
    }

    .saran-perbaikan-column .form-textarea {
        border: none;
        height: 100px;
        padding: 0;
    }

    .saran-perbaikan-column .form-textarea:focus {
        border: none;
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
        border-radius: 3.2px;
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
       10. MODALS - IMAGE ZOOM
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
       11. MODALS - CLOSING VALIDATION
       ======================================== */
    .modal-closing {
        align-items: center;
        background: #FCFCFD;
        border-radius: 12px;
        box-shadow: 0px 0px 20px 5px rgba(20, 20, 20, 0.12);
        display: flex;
        flex-direction: column;
        gap: 12px;
        height: auto;
        padding: 20px;
        width: 338px;
    }

    .modal-closing-image {
        height: 84px;
        object-fit: contain;
        width: 61.06px;
    }

    .modal-closing-title {
        color: #0B4A6F;
        font-family: 'Public Sans', sans-serif;
        font-size: 20px;
        font-weight: 600;
        line-height: 24px;
        margin: 0;
        text-align: center;
    }

    .modal-closing-buttons {
        align-items: flex-start;
        display: flex;
        flex-direction: row;
        gap: 13.39px;
        height: 38.51px;
        padding: 0px;
        width: 298px;
    }

    .btn-closing-cancel {
        align-items: center;
        background: #FFFFFF;
        border: 0.837079px solid #0B4A6F;
        border-radius: 6.69663px;
        box-shadow: 0px 0.837079px 6.69663px rgba(16, 24, 40, 0.16);
        color: #0B4A6F;
        cursor: pointer;
        display: flex;
        flex-direction: row;
        font-family: 'Public Sans', sans-serif;
        font-size: 11.7191px;
        font-weight: 600;
        gap: 6.7px;
        height: 38.51px;
        justify-content: center;
        line-height: 14px;
        padding: 6.69663px 13.3933px;
        transition: all 0.2s ease;
        width: 142.3px;
    }

    .btn-closing-cancel:hover {
        background: var(--ubs-background-grey);
    }

    .btn-closing-confirm {
        display: flex;
        flex-direction: row;
        justify-content: center;
        align-items: center;
        padding: 6.69663px 13.3933px;
        gap: 6.7px;
        width: 142.3px;
        height: 38.51px;
        background: #0B4A6F;
        border: 0.837079px solid #0B4A6F;
        box-shadow: 0px 0.837079px 6.69663px rgba(16, 24, 40, 0.16);
        border-radius: 3.34831px;
        font-family: 'Public Sans', sans-serif;
        font-weight: 600;
        font-size: 11.7191px;
        line-height: 14px;
        color: #F6FEF9;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .btn-closing-confirm:hover {
        background: var(--ubs-bright-blue);
    }

    /* ========================================
       12. STATUS STYLES
       ======================================== */
    .status-open {
        color: #F04438;
    }

    .status-progress {
        color: #F79009;
    }

    .status-closed {
        color: #039855;
    }

    /* ========================================
       13. SARAN BOX
       ======================================== */
    .saran-box {
        font-size: 12px;
        line-height: 1.4;
    }

    .saran-box strong {
        display: block;
        margin-top: 8px;
        margin-bottom: 4px;
        font-weight: 600;
    }

    .saran-box strong:first-child {
        margin-top: 0;
    }

    .saran-box p {
        margin: 0;
        padding: 0;
    }

    /* ========================================
       14. TABLE FOOTER & PAGINATION
       ======================================== */
    .table-footer {
        align-items: center;
        display: flex;
        justify-content: space-between;
        padding: 16px 20px;
    }

    .footer-info {
        color: #667085;
        font-family: 'Public Sans', sans-serif;
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

    .pagination-btn:hover {
        background: #F9FAFB;
        border-color: var(--ubs-blue);
    }

    .pagination-btn:disabled {
        cursor: not-allowed;
        opacity: 0.4;
    }
</style>

<div class="inspeksi-container">
    <!-- ========== FILTER BAR ========== -->
    <div class="filter-bar">
        <select class="filter-select" id="filterDepartemen">
            <option value="">Pilih Departemen</option>
            @foreach($departments as $dept)
            <option value="{{ $dept->nama_dept }}">{{ $dept->nama_dept }}</option>
            @endforeach
        </select>
        <button class="btn-filter" onclick="applyFilter()">
            <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M11.6667 10.2667H10.9293L10.668 10.0147C11.5827 8.95067 12.1333 7.56933 12.1333 6.06667C12.1333 2.716 9.41733 0 6.06667 0C2.716 0 0 2.716 0 6.06667C0 9.41733 2.716 12.1333 6.06667 12.1333C7.56933 12.1333 8.95067 11.5827 10.0147 10.668L10.2667 10.9293V11.6667L14.9333 16.324L16.324 14.9333L11.6667 10.2667ZM6.06667 10.2667C3.74267 10.2667 1.86667 8.39067 1.86667 6.06667C1.86667 3.74267 3.74267 1.86667 6.06667 1.86667C8.39067 1.86667 10.2667 3.74267 10.2667 6.06667C10.2667 8.39067 8.39067 10.2667 6.06667 10.2667Z" fill="white"/>
            </svg>
            Filter
        </button>
    </div>

    <!-- ========== DATA TABLE ========== -->
    <div class="table-container">
        <div class="table-header">
            <h3 class="table-title">List Inspeksi</h3>
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
            <table class="inspeksi-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Bukti Inspeksi</th>
                        <th>Tgl Inspeksi</th>
                        <th>Dept</th>
                        <th>Lokasi</th>
                        <th>Deskripsi</th>
                        <th>Standar / Dokumen Terkait</th>
                        <th>Sumber Peraturan / Persyaratan</th>
                        <th>Saran Perbaikan</th>
                        <th>Status Perbaikan</th>
                        <th>Tgl Perbaikan</th>
                        <th>Aksi</th>
                        <th>Dokumen</th>
                    </tr>
                </thead>
                <tbody id="inspeksiTableBody">
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

<!-- ========== DELETE MODAL ========== -->
<div id="modal-delete" class="modal-overlay">
    <div class="modal-delete">
        <div class="modal-delete-image"></div>
        <h3 class="modal-delete-title">Hapus Inspeksi ?</h3>
        <div class="modal-delete-buttons">
            <button class="btn-delete-base btn-delete-cancel" onclick="closeDeleteModal()">Batal</button>
            <button class="btn-delete-base btn-delete-confirm" onclick="confirmDelete()">Hapus</button>
        </div>
    </div>
</div>

<!-- ========== CLOSING VALIDATION MODAL ========== -->
<div id="modal-closing" class="modal-overlay">
    <div class="modal-closing">
        <img src="{{ asset('img/lock-closing-illustration.png') }}" alt="Close Inspection" class="modal-closing-image">
        <h3 class="modal-closing-title">Tutup Inspeksi?</h3>
        <div class="modal-closing-buttons">
            <button class="btn-closing-cancel" onclick="closeClosingModal()">Batal</button>
            <button class="btn-closing-confirm" onclick="confirmClosing()">Ya</button>
        </div>
    </div>
</div>

<!-- ========== EDIT MODAL ========== -->
<div id="modal-edit" class="modal-overlay">
    <div class="modal-edit">
        <div class="modal-edit-header">
            <h3 class="modal-edit-title">Edit Inspeksi</h3>
            <button class="btn-close" onclick="closeEditModal()">
                <svg width="22.4" height="22.4" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6L6 18M6 6L18 18" stroke="#737373" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        <div class="modal-edit-body">
            <div class="modal-edit-image-section">
                <img id="editImage" src="" alt="Bukti Inspeksi" class="modal-edit-image">
                <input type="file" id="fileImageInput" style="display: none;" accept="image/*">
                <button class="btn-upload-image" onclick="uploadNewImage()">Upload Gambar Baru</button>
            </div>
            
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Departemen</label>
                    <select id="editDept" class="form-select">
                        <option value="">Pilih Departemen</option>
                        @foreach($departments as $dept)
                        <option value="{{ $dept->nama_dept }}" data-id="{{ $dept->kode_dept }}">{{ $dept->nama_dept }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Lokasi</label>
                    <select id="editLokasi" class="form-select">
                        <option value="">Pilih Lokasi</option>
                        @foreach($locations as $location)
                        <option value="{{ $location->nama_lokasi }}" data-id="{{ $location->kode_lokasi }}">{{ $location->nama_lokasi }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group-full">
                <label class="form-label">Deskripsi</label>
                <textarea id="editDeskripsi" class="form-textarea" placeholder="Masukkan deskripsi temuan"></textarea>
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Standar / Dokumen Terkait</label>
                    <input type="text" id="editStandar" class="form-input" placeholder="Masukkan standar">
                </div>
                <div class="form-group">
                    <label class="form-label">Sumber Peraturan / Persyaratan</label>
                    <input type="text" id="editSumber" class="form-input" placeholder="Masukkan sumber">
                </div>
            </div>

            <div class="form-group-full">
                <label class="form-label">Saran Perbaikan</label>
                <div class="saran-perbaikan-box">
                    <div class="saran-perbaikan-column">
                        <label class="form-label">Koreksi</label>
                        <textarea id="editSaranKoreksi" class="form-textarea" placeholder="Masukkan saran koreksi"></textarea>
                    </div>
                    <div class="saran-perbaikan-column">
                        <label class="form-label">Korektif</label>
                        <textarea id="editSaranKorektif" class="form-textarea" placeholder="Masukkan saran korektif"></textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-edit-footer">
            <button class="btn-modal-cancel" onclick="closeEditModal()">Batal</button>
            <button class="btn-save" onclick="saveEdit()">Simpan</button>
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
    let currentInspectionId = null;
    let allRows = [];
    let filteredRows = [];
    let currentEntriesPerPage = 5;
    let currentPage = 1;
    let totalRecords = 0;
    let inspectionsData = [];

    // ========== API FUNCTIONS ==========
    async function loadInspections(dept = null) {
        try {
            let url = '/api/transaksi-inspeksi?per_page=100';
            if (dept) {
                url += '&departemen=' + encodeURIComponent(dept);
            }
            
            const response = await fetch(url, {
                headers: {
                    'Content-Type': 'application/json'
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
            
            inspectionsData = data.data;
            
            renderTable(inspectionsData);
        } catch (error) {
            console.error('Error loading inspections:', error);
            alert('Gagal memuat data inspeksi: ' + error.message);
        }
    }

    function renderTable(data) {
        const tbody = document.getElementById('inspeksiTableBody');
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
            
            const tglPerbaikan = item.tgl_perbaikan ? new Date(item.tgl_perbaikan).toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'long',
                year: 'numeric'
            }) : '-';
            
            // Determine status color
            let statusSvg = '';
            let statusClass = '';
            if (item.status === null) {
                statusSvg = '-'
            } else if (item.status === 'Closed') {
                statusSvg = '<svg width="11" height="24" viewBox="0 0 11 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M0 5.01C0 3.63 0.49 2.45 1.47 1.47C2.45 0.49 3.63 0 5.01 0C6.39 0 7.57 0.49 8.55 1.47C9.53 2.45 10.03 3.63 10.05 5.01C10.05 5.17 10.03 5.31 9.99 5.43L8.34 11.94C8.28 12.82 7.93 13.56 7.29 14.16C6.65 14.76 5.89 15.06 5.01 15.06C4.15 15.06 3.4 14.77 2.76 14.19C2.12 13.61 1.76 12.89 1.68 12.03C1.48 11.43 1.27 10.77 1.05 10.05C0.83 9.33 0.6 8.46 0.36 7.44C0.12 6.42 0 5.61 0 5.01ZM1.65 20.07C1.65 19.15 1.98 18.37 2.64 17.73C3.3 17.09 4.09 16.76 5.01 16.74C5.93 16.72 6.72 17.05 7.38 17.73C8.04 18.41 8.37 19.19 8.37 20.07C8.37 21.01 8.04 21.8 7.38 22.44C6.72 23.08 5.93 23.41 5.01 23.43C4.09 23.45 3.3 23.12 2.64 22.44C1.98 21.76 1.65 20.97 1.65 20.07Z" fill="#039855"/></svg>';
                statusClass = 'status-closed';
            } else if (item.tgl_perbaikan) {
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
                <td>${item.inspect_h?.departemen?.nama_dept || '-'}</td>
                <td>${item.inspect_h?.lokasi?.nama_lokasi || '-'}</td>
                <td>${item.deskripsi || '-'}</td>
                <td>${item.dokumen || '-'}</td>
                <td>${item.referensi || '-'}</td>
                <td><div class="saran-box"><strong>Koreksi:</strong><p>${item.saran_koreksi || '-'}</p><strong>Korektif:</strong><p>${item.saran_korektif || '-'}</p></div></td>
                <td class="status-icon">
                    <span class="status-indicator ${statusClass}" data-status="${item.status}">
                        ${statusSvg}
                    </span>
                </td>
                <td>${tglPerbaikan}</td>
                <td>
                    <div class="action-buttons">
                        <button class="btn-action btn-edit" onclick="openEditModal('${item.no_dokumen},${item.sub}')">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 13.502H2.8125L11.1075 5.20703L8.295 2.39453L0 10.6895V13.502ZM1.5 11.312L8.295 4.51703L8.985 5.20703L2.19 12.002H1.5V11.312Z" fill="currentColor"/>
                                <path d="M11.5277 0.219375C11.2352 -0.073125 10.7627 -0.073125 10.4702 0.219375L9.09766 1.59187L11.9102 4.40438L13.2827 3.03188C13.5752 2.73938 13.5752 2.26688 13.2827 1.97438L11.5277 0.219375Z" fill="currentColor"/>
                            </svg>
                        </button>
                        <button class="btn-action btn-delete" onclick="openDeleteModal('${item.no_dokumen},${item.sub}')">
                            <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4.5 0L3.75 0.75H0V2.25H0.75V13.5C0.75 13.8917 0.893497 14.291 1.17627 14.5737C1.45904 14.8565 1.85833 15 2.25 15H9.75C10.1417 15 10.541 14.8565 10.8237 14.5737C11.1065 14.291 11.25 13.8917 11.25 13.5V2.25H12V0.75H8.25L7.5 0H4.5ZM2.25 2.25H9.75V13.5H2.25V2.25ZM3.75 3.75V12H5.25V3.75H3.75ZM6.75 3.75V12H8.25V3.75H6.75Z" fill="currentColor"/>
                            </svg>
                        </button>
                        ${(!item.status || item.status === 'Open') && item.tgl_perbaikan ? `
                        <button class="btn-action btn-send" onclick="openClosingModal('${item.no_dokumen},${item.sub}')">
                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5075 2.2725L7.14 4.6875L1.5 3.9375L1.5075 2.2725ZM7.1325 8.8125L1.5 11.2275V9.5625L7.1325 8.8125ZM0.00749999 0L0 5.25L11.25 6.75L0 8.25L0.00749999 13.5L15.75 6.75L0.00749999 0Z" fill="white"/>
                            </svg>
                        </button>
                        ` : `
                        ${(!item.status || item.status === 'Open') && !item.tgl_perbaikan ? `
                        <button class="btn-action btn-send" onclick="openSendModal('${item.no_dokumen},${item.sub}')">
                            <svg width="16" height="14" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1.5075 2.2725L7.14 4.6875L1.5 3.9375L1.5075 2.2725ZM7.1325 8.8125L1.5 11.2275V9.5625L7.1325 8.8125ZM0.00749999 0L0 5.25L11.25 6.75L0 8.25L0.00749999 13.5L15.75 6.75L0.00749999 0Z" fill="white"/>
                            </svg>
                        </button>
                        ` : ''}`}
                    </div>
                </td>
                <td>${item.bukti_perbaikan ? `<img src="/storage/bukti_perbaikan/${item.bukti_perbaikan}" alt="Dokumen" class="dokumen-image" onclick="openImageZoom(this.src)" style="cursor: zoom-in;">` : '-'}</td>
            `;
            
            tbody.appendChild(row);
        });
        
        allRows = Array.from(tbody.querySelectorAll('tr'));
        filteredRows = [...allRows];
        applyFilters();
    }

    // ========== HELPER FUNCTIONS ==========
    function convertToDateInput(dateStr) {
        if (!dateStr) return '';
        const date = new Date(dateStr);
        return date.toISOString().split('T')[0];
    }

    function convertFromDateInput(dateStr) {
        if (!dateStr) return '-';
        const date = new Date(dateStr);
        return date.toLocaleDateString('en-US', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }

    // ========== INITIALIZATION ==========
    window.addEventListener('DOMContentLoaded', function() {
        loadInspections();
    });

    // ========== FILTER FUNCTIONS ==========
    function applyFilter() {
        const dept = document.getElementById('filterDepartemen').value;
        loadInspections(dept || null);
    }

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

    // ========== MODAL FUNCTIONS: SEND ==========
    function openSendModal(id) {
        currentInspectionId = id;
        document.getElementById('modal-send').classList.add('active');
    }

    function closeSendModal() {
        document.getElementById('modal-send').classList.remove('active');
        currentInspectionId = null;
    }

    async function confirmSend() {
        if (currentInspectionId) {
            try {
                const response = await fetch('/api/transaksi-inspeksi/' + currentInspectionId, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({ status: 'Open' })
                });
                
                if (!response.ok) throw new Error('Failed to update');
                
                await loadInspections(document.getElementById('filterDepartemen').value);
                alert('Data berhasil diperbarui');
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memperbarui data');
            }
        }
        closeSendModal();
    }

    // ========== MODAL FUNCTIONS: DELETE ==========
    function openDeleteModal(id) {
        currentInspectionId = id;
        document.getElementById('modal-delete').classList.add('active');
    }

    function closeDeleteModal() {
        document.getElementById('modal-delete').classList.remove('active');
        currentInspectionId = null;
    }

    async function confirmDelete() {
        if (currentInspectionId) {
            try {
                const response = await fetch('/api/transaksi-inspeksi/' + currentInspectionId, {
                    method: 'DELETE',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });
                
                if (!response.ok) throw new Error('Failed to delete');
                
                await loadInspections(document.getElementById('filterDepartemen').value);
                alert('Data berhasil dihapus');
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal menghapus data');
            }
        }
        closeDeleteModal();
    }

    // ========== MODAL FUNCTIONS: EDIT ==========
    function openEditModal(id) {
        currentInspectionId = id;
        const data = inspectionsData.find(item => item.no_dokumen + ',' + item.sub === id);
        
        if (data) {
            // Display existing bukti_temuan image if available
            if (data.bukti_temuan) {
                document.getElementById('editImage').src = '/storage/bukti_temuan/' + data.bukti_temuan;
            } else {
                document.getElementById('editImage').src = '';
            }
            
            document.getElementById('editDept').value = data.inspect_h?.departemen?.nama_dept || '';
            document.getElementById('editLokasi').value = data.inspect_h?.lokasi?.nama_lokasi || '';
            document.getElementById('editDeskripsi').value = data.deskripsi || '';
            document.getElementById('editStandar').value = data.dokumen || '';
            document.getElementById('editSumber').value = data.referensi || '';
            document.getElementById('editSaranKoreksi').value = data.saran_koreksi || '';
            document.getElementById('editSaranKorektif').value = data.saran_korektif || '';
            
            // Clear file input
            const fileInput = document.getElementById('fileImageInput');
            if (fileInput) fileInput.value = '';
        }
        
        document.getElementById('modal-edit').classList.add('active');
    }

    function closeEditModal() {
        document.getElementById('modal-edit').classList.remove('active');
        currentInspectionId = null;
    }

    function uploadNewImage() {
        document.getElementById('fileImageInput').click();
    }

    // Handle file selection
    document.getElementById('fileImageInput')?.addEventListener('change', async function(e) {
        const file = e.target.files[0];
        if (!file) return;

        // Preview image
        const reader = new FileReader();
        reader.onload = function(event) {
            document.getElementById('editImage').src = event.target.result;
        };
        reader.readAsDataURL(file);
    });

    async function saveEdit() {
        if (currentInspectionId) {
            try {
                // Get the ID values from the selected dropdown options
                const deptSelect = document.getElementById('editDept');
                const deptCode = deptSelect.options[deptSelect.selectedIndex]?.dataset.id || '';

                const lokasiSelect = document.getElementById('editLokasi');
                const lokasiCode = lokasiSelect.options[lokasiSelect.selectedIndex]?.dataset.id || '';

                let buktiTemuanPath = '';
                
                // Check if there's a new image file selected
                const fileInput = document.getElementById('fileImageInput');
                if (fileInput && fileInput.files.length > 0) {
                    const file = fileInput.files[0];
                    const [no_dokumen, sub] = currentInspectionId.split(',');
                    
                    // Upload file and get path
                    const formData = new FormData();
                    formData.append('file', file);
                    formData.append('no_dokumen', no_dokumen);
                    
                    const uploadResponse = await fetch('/api/transaksi-inspeksi/upload', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                        },
                        body: formData
                    });
                    
                    if (!uploadResponse.ok) throw new Error('Failed to upload image');
                    
                    const uploadData = await uploadResponse.json();
                    buktiTemuanPath = uploadData.file_name;
                }

                const response = await fetch('/api/transaksi-inspeksi/' + currentInspectionId, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    },
                    body: JSON.stringify({
                        dokumen: document.getElementById('editStandar').value,
                        referensi: document.getElementById('editSumber').value,
                        deskripsi: document.getElementById('editDeskripsi').value,
                        saran_koreksi: document.getElementById('editSaranKoreksi').value,
                        saran_korektif: document.getElementById('editSaranKorektif').value,
                        kode_dept: deptCode,
                        kode_lokasi: lokasiCode,
                        bukti_temuan: buktiTemuanPath
                    })
                });
                
                if (!response.ok) throw new Error('Failed to update');
                
                // Clear file input after successful save
                if (fileInput) {
                    fileInput.value = '';
                }
                
                await loadInspections(document.getElementById('filterDepartemen').value);
                alert('Data berhasil diperbarui');
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal memperbarui data');
            }
        }
        closeEditModal();
    }

    // ========== MODAL FUNCTIONS: IMAGE ZOOM ==========
    function openImageZoom(imageSrc) {
        document.getElementById('zoomedImage').src = imageSrc;
        document.getElementById('imageZoomModal').classList.add('active');
    }

    function closeImageZoom() {
        document.getElementById('imageZoomModal').classList.remove('active');
    }

    // ========== MODAL FUNCTIONS: CLOSING VALIDATION ==========
    function openClosingModal(inspectionId) {
        currentInspectionId = inspectionId;
        document.getElementById('modal-closing').classList.add('active');
    }

    function closeClosingModal() {
        document.getElementById('modal-closing').classList.remove('active');
        currentInspectionId = null;
    }

    async function confirmClosing() {
        if (currentInspectionId) {
            try {
                const response = await fetch('/api/transaksi-closing/' + currentInspectionId, {
                    method: 'PUT',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
                    }
                });
                
                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || 'Failed to close inspection');
                }
                
                await loadInspections(document.getElementById('filterDepartemen').value);
                alert('Inspeksi berhasil ditutup');
            } catch (error) {
                console.error('Error:', error);
                alert('Gagal menutup inspeksi');
            }
        }
        closeClosingModal();
    }

    // ========== EVENT LISTENERS ==========
    document.querySelectorAll('.modal-overlay').forEach(modal => {
        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
                currentInspectionId = null;
            }
        });
    });
</script>
@endsection