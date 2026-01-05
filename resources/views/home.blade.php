@extends('layouts.app')

@section('title', 'Home')

@push('styles')
<style>
    .hero-section {
        position: relative;
        width: 100%;
        height: calc(100vh - 170px); /* Fill remaining viewport after navbars */
        overflow: hidden;
        margin-left: calc(-50vw + 50%);
        margin-right: calc(-50vw + 50%);
    }

    .hero-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
    }

    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.4);
        z-index: 1;
    }

    /* Remove container padding for full-width effect */
    main.container-fluid {
        padding: 0 !important;
    }

    /* Mobile responsive adjustments */
    @media (max-width: 991px) {
        .hero-section {
            height: calc(100vh - 200px); /* Fill remaining space on mobile */
        }
    }
</style>
@endpush

@section('content')
<div class="hero-section">
    <img src="{{ asset('img/hero-warehouse.jpg') }}" alt="QHSE Warehouse" class="hero-image">
    <div class="hero-overlay"></div>
</div>
@endsection
