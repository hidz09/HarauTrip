@extends('layouts.main')

@section('title', 'Edit Booking')

@section('content')

<style>
    .edit-booking-page {
        background: #f5f1e8;
        min-height: calc(100vh - 57px);
        padding: 25px;
    }

    .edit-booking-card {
        background: #ffffff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(16, 44, 34, 0.08);
        overflow: hidden;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* HEADER */
    .edit-booking-header {
        background: #102c22;
        color: #ffffff;
        padding: 20px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .edit-booking-header h3 {
        margin: 0;
        font-family: Georgia, serif;
        font-weight: 700;
        font-size: 24px;
    }

    .edit-booking-header small {
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
    .edit-booking-body {
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

    /* FOOTER */
    .edit-booking-footer {
        background: #faf7f0;
        border-top: 1px solid #eee8dc;
        padding: 18px 30px;
    }

    /* BUTTON UPDATE */
    .btn-update {
        background: #102c22;
        color: #ffffff !important;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-update:hover {
        background: #1b4738;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* BUTTON BATAL */
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

        .edit-booking-page {
            padding: 15px;
        }

        .edit-booking-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .edit-booking-header .btn-back {
            width: 100%;
            text-align: center;
        }

        .edit-booking-body {
            padding: 20px;
        }

        .edit-booking-footer {
            padding: 15px 20px;
        }
    }
</style>

<div class="edit-booking-page">

    <div class="edit-booking-card">

        {{-- HEADER --}}
        <div class="edit-booking-header">

            <div>
                <h3>Edit Booking</h3>
                <small>Perbarui informasi booking wisata</small>
            </div>

            <a href="{{ route('admin.booking.index') }}"
               class="btn btn-back">

                <i class="fas fa-arrow-left mr-1"></i>
                Kembali

            </a>

        </div>


        {{-- FORM --}}
        <form action="{{ route('admin.booking.update', $booking->id) }}"
              method="POST">

            @csrf
            @method('PUT')

            <div class="edit-booking-body">

                {{-- PAKET WISATA --}}
                <div class="form-group">

                    <label>
                        Paket Wisata
                    </label>

                    <select name="tour_package_id"
                            class="form-control"
                            required>

                        @foreach($packages as $package)

                            <option value="{{ $package->id }}"
                                {{ $booking->tour_package_id == $package->id ? 'selected' : '' }}>

                                {{ $package->name }}
                                - Rp {{ number_format($package->price, 0, ',', '.') }}

                            </option>

                        @endforeach

                    </select>

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
                        value="{{ old('booking_date', $booking->booking_date->format('Y-m-d')) }}"
                        required>

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
                        value="{{ old('total_people', $booking->total_people) }}"
                        required>

                </div>


                {{-- STATUS --}}
                <div class="form-group">

                    <label>
                        Status Booking
                    </label>

                    <select name="status"
                            class="form-control">

                        <option value="Pending"
                            {{ $booking->status == 'Pending' ? 'selected' : '' }}>
                            Pending
                        </option>

                        <option value="Confirmed"
                            {{ $booking->status == 'Confirmed' ? 'selected' : '' }}>
                            Confirmed
                        </option>

                        <option value="Completed"
                            {{ $booking->status == 'Completed' ? 'selected' : '' }}>
                            Completed
                        </option>

                        <option value="Cancelled"
                            {{ $booking->status == 'Cancelled' ? 'selected' : '' }}>
                            Cancelled
                        </option>

                    </select>

                </div>

            </div>


            {{-- FOOTER --}}
            <div class="edit-booking-footer">

                <button type="submit"
                        class="btn btn-update">

                    <i class="fas fa-save mr-1"></i>
                    Update Booking

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