@extends('layouts.main')

@section('title', 'Tambah Booking')

@section('content')

<style>
    .add-booking-page {
        background: #f5f1e8;
        min-height: calc(100vh - 57px);
        padding: 25px;
    }

    .add-booking-card {
        background: #ffffff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(16, 44, 34, 0.08);
        overflow: hidden;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* HEADER */
    .add-booking-header {
        background: #102c22;
        color: #ffffff;
        padding: 20px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .add-booking-header h3 {
        margin: 0;
        font-family: Georgia, serif;
        font-weight: 700;
        font-size: 24px;
    }

    .add-booking-header small {
        color: #d6ad73;
        font-size: 13px;
    }

    /* TOMBOL KEMBALI */
    .btn-back {
        background: rgba(255, 255, 255, 0.12);
        color: #ffffff !important;
        border: 1px solid rgba(255, 255, 255, 0.25);
        border-radius: 8px;
        padding: 8px 14px;
        font-weight: 500;
        transition: 0.2s;
    }

    .btn-back:hover {
        background: #d6ad73;
        border-color: #d6ad73;
        color: #102c22 !important;
    }

    /* BODY */
    .add-booking-body {
        padding: 30px;
    }

    /* FORM */
    .form-group {
        margin-bottom: 23px;
    }

    .form-group label {
        display: block;
        color: #102c22;
        font-weight: 600;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .form-control {
        height: 46px;
        border: 1px solid #ddd7ca;
        border-radius: 9px;
        background: #ffffff;
        color: #39443e;
        padding: 10px 14px;
        box-shadow: none;
        transition: 0.2s;
    }

    .form-control:focus {
        border-color: #d6ad73;
        box-shadow: 0 0 0 3px rgba(214, 173, 115, 0.15);
    }

    select.form-control {
        cursor: pointer;
    }

    /* ERROR */
    .text-danger {
        display: block;
        margin-top: 6px;
        font-size: 12px;
        color: #a33d3d !important;
    }

    /* CATATAN */
    .booking-note {
        background: #f8f1e3;
        border: 1px solid #ead8b9;
        border-left: 4px solid #d6ad73;
        color: #5e513d;
        border-radius: 9px;
        padding: 14px 16px;
        margin-top: 5px;
        font-size: 13px;
    }

    .booking-note strong {
        color: #102c22;
    }

    /* FOOTER */
    .add-booking-footer {
        background: #faf7f0;
        border-top: 1px solid #eee8dc;
        padding: 18px 30px;
    }

    /* SIMPAN */
    .btn-save {
        background: #102c22;
        color: #ffffff !important;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-save:hover {
        background: #1b4738;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* BATAL */
    .btn-cancel {
        background: #ebe7df;
        color: #4c514d !important;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
        margin-left: 5px;
        transition: 0.2s;
    }

    .btn-cancel:hover {
        background: #ddd7ca;
        color: #102c22 !important;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {

        .add-booking-page {
            padding: 15px;
        }

        .add-booking-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .add-booking-header .btn-back {
            width: 100%;
            text-align: center;
        }

        .add-booking-body {
            padding: 20px;
        }

        .add-booking-footer {
            padding: 15px 20px;
        }
    }
</style>


<div class="add-booking-page">

    <div class="add-booking-card">

        {{-- HEADER --}}
        <div class="add-booking-header">

            <div>
                <h3>Tambah Booking</h3>
                <small>Buat data booking wisata baru</small>
            </div>

            <a href="{{ route('admin.booking.index') }}"
               class="btn btn-back">

                <i class="fas fa-arrow-left mr-1"></i>
                Kembali

            </a>

        </div>


        {{-- FORM --}}
        <form action="{{ route('admin.booking.store') }}"
              method="POST">

            @csrf

            <div class="add-booking-body">

                {{-- PAKET WISATA --}}
                <div class="form-group">

                    <label>
                        Pilih Paket Wisata
                    </label>

                    <select name="tour_package_id"
                            class="form-control"
                            required>

                        <option value="">
                            -- Pilih Paket --
                        </option>

                        @foreach($packages as $package)

                            <option
                                value="{{ $package->id }}"
                                {{ old('tour_package_id') == $package->id ? 'selected' : '' }}>

                                {{ $package->name }}
                                - Rp {{ number_format($package->price, 0, ',', '.') }}

                            </option>

                        @endforeach

                    </select>

                    @error('tour_package_id')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- TANGGAL BOOKING --}}
                <div class="form-group">

                    <label>
                        Tanggal Booking
                    </label>

                    <input
                        type="date"
                        name="booking_date"
                        class="form-control"
                        value="{{ old('booking_date') }}"
                        required>

                    @error('booking_date')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- JUMLAH ORANG --}}
                <div class="form-group">

                    <label>
                        Jumlah Orang
                    </label>

                    <input
                        type="number"
                        name="total_people"
                        class="form-control"
                        min="1"
                        value="{{ old('total_people', 1) }}"
                        required>

                    @error('total_people')
                        <small class="text-danger">
                            {{ $message }}
                        </small>
                    @enderror

                </div>


                {{-- CATATAN --}}
                <div class="booking-note">

                    <strong>
                        <i class="fas fa-info-circle mr-1"></i>
                        Catatan:
                    </strong>

                    Total harga dihitung otomatis berdasarkan
                    harga paket × jumlah orang.
                    Booking dibuat dengan status
                    <strong>Pending</strong>.

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="add-booking-footer">

                <button type="submit"
                        class="btn btn-save">

                    <i class="fas fa-save mr-1"></i>
                    Simpan Booking

                </button>

                <a href="{{ route('admin.booking.index') }}"
                   class="btn btn-cancel">

                    Batal

                </a>

            </div>

        </form>

    </div>

</div>

@endsection