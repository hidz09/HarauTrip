@extends('layouts.main')

@section('title', 'Halaman Utama')

@push('css')
<style>
    /* ===== Brand color override untuk small-box AdminLTE ===== */
    .small-box.bg-brand-primary {
        background-color: #0e7a3f !important;
        color: #fff;
    }
    .small-box.bg-brand-primary .small-box-footer {
        background-color: rgba(0,0,0,0.12);
        color: #fff;
    }
    .small-box.bg-brand-primary .small-box-footer:hover {
        background-color: rgba(0,0,0,0.2);
        color: #fff;
    }

    .small-box.bg-brand-accent {
        background-color: #ea6a12 !important;
        color: #fff;
    }
    .small-box.bg-brand-accent .small-box-footer {
        background-color: rgba(0,0,0,0.12);
        color: #fff;
    }
    .small-box.bg-brand-accent .small-box-footer:hover {
        background-color: rgba(0,0,0,0.2);
        color: #fff;
    }

    .small-box.bg-brand-dark {
        background-color: #182420 !important;
        color: #fff;
    }
    .small-box.bg-brand-dark .small-box-footer {
        background-color: rgba(255,255,255,0.08);
        color: #fff;
    }
    .small-box.bg-brand-dark .small-box-footer:hover {
        background-color: rgba(255,255,255,0.15);
        color: #fff;
    }

    .small-box.bg-brand-tan {
        background-color: #b98a58 !important;
        color: #fff;
    }
    .small-box.bg-brand-tan .small-box-footer {
        background-color: rgba(0,0,0,0.12);
        color: #fff;
    }
    .small-box.bg-brand-tan .small-box-footer:hover {
        background-color: rgba(0,0,0,0.2);
        color: #fff;
    }
</style>
@endpush

@section('content')
    <div class="row">

        {{-- TOTAL BOOKING --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-brand-primary">
                <div class="inner">
                    <h3>{{ $totalBookings ?? 0 }}</h3>
                    <p>Total Booking</p>
                </div>
                <div class="icon">
                    <i class="fas fa-suitcase-rolling"></i>
                </div>
                <a href="{{ route('admin.booking.index') }}" class="small-box-footer">
                    Lihat detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- PENDAPATAN --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-brand-accent">
                <div class="inner">
                    <h3>Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</h3>
                    <p>Pendapatan Bulan Ini</p>
                </div>
                <div class="icon">
                    <i class="fas fa-sack-dollar"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Lihat detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- PENGGUNA BARU --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-brand-tan">
                <div class="inner">
                    <h3>{{ $newUsers ?? 0 }}</h3>
                    <p>Pengguna Baru</p>
                </div>
                <div class="icon">
                    <i class="fas fa-user-plus"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Lihat detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

        {{-- PAKET AKTIF --}}
        <div class="col-lg-3 col-6">
            <div class="small-box bg-brand-dark">
                <div class="inner">
                    <h3>{{ $activePackages ?? 0 }}</h3>
                    <p>Paket Wisata Aktif</p>
                </div>
                <div class="icon">
                    <i class="fas fa-map-location-dot"></i>
                </div>
                <a href="#" class="small-box-footer">
                    Lihat detail <i class="fas fa-arrow-circle-right"></i>
                </a>
            </div>
        </div>

    </div>
@endsection