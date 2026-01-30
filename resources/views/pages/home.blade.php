@extends('layouts.main')

@section('title', 'Home')

@push('styles')
<style>
    /* Remove body background for home page */
    body {
        background: none !important;
    }

    .hero-section {
        position: relative;
        width: 100%;
        height: calc(100vh - 124px); /* Fill remaining viewport after navbars (90px + 34px) */
        overflow: hidden;
    }

    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(342.89deg, rgba(0, 0, 0, 0) 17.67%, rgba(58, 58, 58, 0.568) 76.64%), url('{{ asset('img/hero-warehouse.jpg') }}');
        background-size: cover;
        background-position: center center;
        background-repeat: no-repeat;
        z-index: 0;
    }

    /* Remove container padding for full-width effect */
    .main-content {
        padding: 0 !important;
    }

    /* Mobile responsive adjustments */
    @media (max-width: 991px) {
        .hero-section {
            height: calc(100vh - 140px); /* Adjusted for mobile navbar */
        }
    }
</style>
@endpush

@section('content')
<div class="hero-section">
    <div class="hero-background"></div>
</div>
@endsection
