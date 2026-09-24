@extends('layouts.main')

@section('title', 'Detail Booking')

@section('content')

<style>
    .detail-booking-page {
        background: #f5f1e8;
        min-height: calc(100vh - 57px);
        padding: 25px;
    }

    .detail-booking-card {
        background: #ffffff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(16, 44, 34, 0.08);
        overflow: hidden;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* HEADER */
    .detail-booking-header {
        background: #102c22;
        color: #ffffff;
        padding: 20px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .detail-booking-header h3 {
        margin: 0;
        font-family: Georgia, serif;
        font-weight: 700;
        font-size: 24px;
    }

    .detail-booking-header small {
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
    .detail-booking-body {
        padding: 30px;
    }

    /* TABLE */
    .detail-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #e7e1d6;
        border-radius: 12px;
        overflow: hidden;
    }

    .detail-table tr {
        transition: 0.15s;
    }

    .detail-table tr:hover {
        background: #faf7f0;
    }

    .detail-table th {
        width: 30%;
        background: #f7f3eb;
        color: #102c22;
        font-weight: 600;
        padding: 15px 18px;
        border-bottom: 1px solid #e7e1d6;
        font-size: 14px;
    }

    .detail-table td {
        color: #4b534e;
        padding: 15px 18px;
        border-bottom: 1px solid #e7e1d6;
        font-size: 14px;
    }

    .detail-table tr:last-child th,
    .detail-table tr:last-child td {
        border-bottom: none;
    }

    /* KODE BOOKING */
    .booking-code {
        display: inline-block;
        background: #e8f0eb;
        color: #174a37;
        padding: 6px 10px;
        border-radius: 7px;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    /* HARGA */
    .package-price {
        color: #9a6f35;
        font-weight: 600;
    }

    .total-price {
        color: #102c22;
        font-size: 18px;
        font-weight: 700;
    }

    /* STATUS */
    .status-badge {
        display: inline-block;
        padding: 6px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
    }

    .status-pending {
        background: #f8ead0;
        color: #956b2f;
    }

    .status-confirmed {
        background: #dfece6;
        color: #235641;
    }

    .status-completed {
        background: #d5e8d9;
        color: #24613a;
    }

    .status-cancelled {
        background: #f2dddd;
        color: #a33d3d;
    }

    /* FOOTER */
    .detail-booking-footer {
        background: #faf7f0;
        border-top: 1px solid #eee8dc;
        padding: 18px 30px;
    }

    /* EDIT */
    .btn-edit {
        background: #d6ad73;
        color: #102c22 !important;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-edit:hover {
        background: #c59b60;
        color: #102c22 !important;
        transform: translateY(-1px);
    }

    /* KEMBALI */
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

        .detail-booking-page {
            padding: 15px;
        }

        .detail-booking-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .detail-booking-header .btn-back {
            width: 100%;
            text-align: center;
        }

        .detail-booking-body {
            padding: 20px;
        }

        .detail-table th {
            width: 40%;
        }

        .detail-table th,
        .detail-table td {
            padding: 12px;
        }

        .detail-booking-footer {
            padding: 15px 20px;
        }
    }
</style>


<div class="detail-booking-page">

    <div class="detail-booking-card">

        {{-- HEADER --}}
        <div class="detail-booking-header">

            <div>
                <h3>Detail Booking</h3>
                <small>Informasi lengkap booking wisata</small>
            </div>

            <a href="{{ route('admin.booking.index') }}"
               class="btn btn-back">

                <i class="fas fa-arrow-left mr-1"></i>
                Kembali

            </a>

        </div>


        {{-- BODY --}}
        <div class="detail-booking-body">

            <table class="detail-table">

                {{-- KODE BOOKING --}}
                <tr>
                    <th>Kode Booking</th>

                    <td>
                        <span class="booking-code">
                            {{ $booking->booking_code }}
                        </span>
                    </td>
                </tr>


                {{-- USER --}}
                <tr>
                    <th>Nama User</th>

                    <td>
                        {{ $booking->user->name ?? '-' }}
                    </td>
                </tr>


                {{-- EMAIL --}}
                <tr>
                    <th>Email</th>

                    <td>
                        {{ $booking->user->email ?? '-' }}
                    </td>
                </tr>


                {{-- PAKET --}}
                <tr>
                    <th>Paket Wisata</th>

                    <td>
                        {{ $booking->package->name ?? '-' }}
                    </td>
                </tr>


                {{-- HARGA PAKET --}}
                <tr>
                    <th>Harga Paket</th>

                    <td>
                        <span class="package-price">
                            Rp {{ number_format($booking->package->price ?? 0, 0, ',', '.') }}
                        </span>
                    </td>
                </tr>


                {{-- TANGGAL --}}
                <tr>
                    <th>Tanggal Booking</th>

                    <td>
                        {{ $booking->booking_date->format('d-m-Y') }}
                    </td>
                </tr>


                {{-- JUMLAH ORANG --}}
                <tr>
                    <th>Jumlah Orang</th>

                    <td>
                        {{ $booking->total_people }} orang
                    </td>
                </tr>


                {{-- TOTAL HARGA --}}
                <tr>
                    <th>Total Harga</th>

                    <td>
                        <span class="total-price">
                            Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                        </span>
                    </td>
                </tr>


                {{-- STATUS --}}
                <tr>
                    <th>Status</th>

                    <td>

                        @if($booking->status == 'Pending')

                            <span class="status-badge status-pending">
                                Pending
                            </span>

                        @elseif($booking->status == 'Confirmed')

                            <span class="status-badge status-confirmed">
                                Confirmed
                            </span>

                        @elseif($booking->status == 'Completed')

                            <span class="status-badge status-completed">
                                Completed
                            </span>

                        @else

                            <span class="status-badge status-cancelled">
                                Cancelled
                            </span>

                        @endif

                    </td>
                </tr>


                {{-- CREATED AT --}}
                <tr>
                    <th>Dibuat Pada</th>

                    <td>
                        {{ $booking->created_at->format('d-m-Y H:i') }}
                    </td>
                </tr>

            </table>

        </div>


        {{-- FOOTER --}}
        <div class="detail-booking-footer">

            <a href="{{ route('admin.booking.edit', $booking->id) }}"
               class="btn btn-edit">

                <i class="fas fa-edit mr-1"></i>
                Edit

            </a>

            <a href="{{ route('admin.booking.index') }}"
               class="btn btn-cancel">

                Kembali

            </a>

        </div>

    </div>

</div>

@endsection