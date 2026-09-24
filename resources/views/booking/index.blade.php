@extends('layouts.main')

@section('title', 'Data Booking')

@section('content')

<style>
    .booking-page {
        background: #f5f1e8;
        min-height: calc(100vh - 57px);
        padding: 25px;
    }

    .booking-card {
        background: #ffffff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(16, 44, 34, 0.08);
        overflow: hidden;
    }

    /* HEADER */
    .booking-header {
        background: #102c22;
        color: #ffffff;
        padding: 20px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .booking-header h3 {
        margin: 0;
        font-family: Georgia, serif;
        font-weight: 700;
        font-size: 24px;
    }

    .booking-header small {
        color: #d6ad73;
        font-size: 13px;
    }

    /* BUTTON TAMBAH */
    .btn-add-booking {
        background: #d6ad73;
        color: #102c22 !important;
        border: none;
        border-radius: 9px;
        padding: 9px 16px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-add-booking:hover {
        background: #c59b60;
        color: #102c22 !important;
        transform: translateY(-1px);
    }

    /* BODY */
    .booking-body {
        padding: 25px;
    }

    /* ALERT */
    .booking-alert {
        background: #e8f1ec;
        border: 1px solid #bfd5c9;
        color: #102c22;
        border-radius: 10px;
        padding: 12px 16px;
        margin-bottom: 20px;
    }

    /* TABLE */
    .booking-table-wrapper {
        overflow-x: auto;
        border-radius: 12px;
        border: 1px solid #e7e1d6;
    }

    .booking-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
        background: #ffffff;
    }

    .booking-table thead {
        background: #102c22;
        color: #ffffff;
    }

    .booking-table thead th {
        padding: 14px 12px;
        border: none;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .booking-table tbody td {
        padding: 13px 12px;
        vertical-align: middle;
        border-top: 1px solid #eee8dc;
        color: #39443e;
        font-size: 14px;
    }

    .booking-table tbody tr {
        transition: 0.15s;
    }

    .booking-table tbody tr:hover {
        background: #faf7f0;
    }

    /* KODE BOOKING */
    .booking-code {
        color: #102c22;
        font-weight: 700;
    }

    /* HARGA */
    .booking-price {
        color: #a4773c;
        font-weight: 700;
        white-space: nowrap;
    }

    /* BADGE STATUS */
    .status-badge {
        display: inline-block;
        padding: 6px 11px;
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

    /* BUTTON AKSI */
    .action-btn {
        width: 34px;
        height: 34px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 8px;
        border: none;
        margin-right: 3px;
        transition: 0.2s;
    }

    .btn-detail {
        background: #e4eee9;
        color: #174a37;
    }

    .btn-detail:hover {
        background: #cddfd5;
        color: #102c22;
    }

    .btn-edit {
        background: #f6ead6;
        color: #9a6f35;
    }

    .btn-edit:hover {
        background: #ead8b9;
        color: #765325;
    }

    .btn-delete {
        background: #f3dede;
        color: #a33d3d;
    }

    .btn-delete:hover {
        background: #e8caca;
        color: #862f2f;
    }

    /* DATA KOSONG */
    .empty-booking {
        padding: 45px 20px !important;
        text-align: center;
        color: #8b8b82 !important;
    }

    .empty-booking i {
        font-size: 40px;
        color: #d6ad73;
        margin-bottom: 12px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .booking-page {
            padding: 15px;
        }

        .booking-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .btn-add-booking {
            width: 100%;
            text-align: center;
        }

        .booking-body {
            padding: 15px;
        }
    }
</style>

<div class="booking-page">

    <div class="booking-card">

        {{-- HEADER --}}
        <div class="booking-header">

            <div>
                <h3>Data Booking</h3>
                <small>Kelola seluruh data booking wisata</small>
            </div>

            <a href="{{ route('admin.booking.create') }}"
               class="btn btn-add-booking">
                <i class="fas fa-plus mr-1"></i>
                Tambah Booking
            </a>

        </div>

        {{-- BODY --}}
        <div class="booking-body">

            @if(session('success'))
                <div class="booking-alert">
                    <i class="fas fa-check-circle mr-1"></i>
                    {{ session('success') }}
                </div>
            @endif

            <div class="booking-table-wrapper">

                <table class="booking-table">

                    <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Kode Booking</th>
                            <th>User</th>
                            <th>Paket Wisata</th>
                            <th>Tanggal</th>
                            <th>Jumlah Orang</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th width="15%">Aksi</th>
                        </tr>
                    </thead>

                    <tbody>

                        @forelse($bookings as $booking)

                            <tr>

                                <td>
                                    {{ $loop->iteration }}
                                </td>

                                <td>
                                    <span class="booking-code">
                                        {{ $booking->booking_code }}
                                    </span>
                                </td>

                                <td>
                                    {{ $booking->user->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $booking->package->name ?? '-' }}
                                </td>

                                <td>
                                    {{ $booking->booking_date->format('d-m-Y') }}
                                </td>

                                <td>
                                    {{ $booking->total_people }} orang
                                </td>

                                <td>
                                    <span class="booking-price">
                                        Rp {{ number_format($booking->total_price, 0, ',', '.') }}
                                    </span>
                                </td>

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

                                <td>

                                    {{-- DETAIL --}}
                                    <a href="{{ route('admin.booking.show', $booking->id) }}"
                                       class="action-btn btn-detail"
                                       title="Lihat detail">

                                        <i class="fas fa-eye"></i>

                                    </a>

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.booking.edit', $booking->id) }}"
                                       class="action-btn btn-edit"
                                       title="Edit booking">

                                        <i class="fas fa-edit"></i>

                                    </a>

                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.booking.delete', $booking->id) }}"
                                          method="POST"
                                          style="display:inline-block;">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                                class="action-btn btn-delete"
                                                title="Hapus booking"
                                                onclick="return confirm('Hapus booking ini?')">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="9" class="empty-booking">

                                    <i class="fas fa-calendar-check d-block"></i>

                                    <strong>Belum ada data booking</strong>

                                    <br>

                                    <small>
                                        Data booking akan muncul di sini.
                                    </small>

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</div>

@endsection