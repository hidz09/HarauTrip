@extends('layouts.operator')

@section('title', 'Booking Hari Ini')

@section('content')

<style>
    .today-page {
        padding: 28px;
    }

    .today-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 22px;
        flex-wrap: wrap;
        gap: 14px;
    }

    .today-header h2 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #102c22;
    }

    .today-header p {
        margin: 3px 0 0;
        font-size: 13px;
        color: #7a8580;
    }

    .date-nav {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #ffffff;
        border: 1px solid #eee9df;
        border-radius: 10px;
        padding: 6px 8px;
    }

    .date-nav a {
        width: 32px;
        height: 32px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #102c22;
        text-decoration: none;
        transition: 0.15s ease;
    }

    .date-nav a:hover {
        background: #f5f1e8;
    }

    .date-nav .date-label {
        font-size: 13px;
        font-weight: 600;
        color: #26332b;
        padding: 0 8px;
        min-width: 130px;
        text-align: center;
    }

    .summary-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 16px;
        margin-bottom: 24px;
    }

    .summary-card {
        background: #ffffff;
        border-radius: 14px;
        padding: 18px 20px;
        box-shadow: 0 4px 16px rgba(16, 44, 34, 0.06);
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .summary-icon {
        width: 44px;
        height: 44px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 17px;
        flex-shrink: 0;
    }

    .summary-icon.total { background: rgba(16, 44, 34, 0.08); color: #102c22; }
    .summary-icon.checked { background: rgba(43, 138, 82, 0.1); color: #2b8a52; }
    .summary-icon.pending { background: rgba(214, 173, 115, 0.15); color: #b3844f; }

    .summary-value {
        font-size: 22px;
        font-weight: 700;
        color: #102c22;
        line-height: 1.1;
    }

    .summary-label {
        font-size: 12px;
        color: #7a8580;
        margin-top: 2px;
    }

    /* TABLE */
    .booking-table-wrap {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(16, 44, 34, 0.06);
    }

    table.booking-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    table.booking-table thead th {
        background: #f5f1e8;
        color: #59645d;
        font-weight: 700;
        text-transform: uppercase;
        font-size: 10.5px;
        letter-spacing: 0.04em;
        padding: 13px 18px;
        text-align: left;
        border-bottom: 1px solid #eee9df;
    }

    table.booking-table tbody td {
        padding: 14px 18px;
        border-bottom: 1px solid #f3f0e8;
        color: #26332b;
        vertical-align: middle;
    }

    table.booking-table tbody tr:last-child td {
        border-bottom: none;
    }

    table.booking-table tbody tr:hover {
        background: #fbfaf6;
    }

    .code-cell {
        font-family: "Courier New", monospace;
        font-weight: 700;
        color: #102c22;
    }

    .status-pill {
        display: inline-block;
        font-size: 10.5px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }

    .status-pill.checked-in {
        background: rgba(43, 138, 82, 0.1);
        color: #2b8a52;
    }

    .status-pill.not-yet {
        background: rgba(214, 173, 115, 0.15);
        color: #b3844f;
    }

    .status-pill.cancelled {
        background: rgba(176, 85, 74, 0.1);
        color: #b0554a;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        color: #a1a69f;
    }

    .empty-state i {
        font-size: 40px;
        display: block;
        margin-bottom: 14px;
        color: #d8dfd9;
    }

    @media (max-width: 900px) {
        .summary-row {
            grid-template-columns: 1fr;
        }

        .booking-table-wrap {
            overflow-x: auto;
        }

        table.booking-table {
            min-width: 700px;
        }
    }
</style>

<div class="today-page">

    <div class="today-header">
        <div>
            <h2>Booking Hari Ini</h2>
            <p>Daftar wisatawan yang dijadwalkan berkunjung</p>
        </div>

        <div class="date-nav">
            <a href="{{ route('operator.today', ['date' => $date->copy()->subDay()->format('Y-m-d')]) }}">
                <i class="fas fa-chevron-left"></i>
            </a>
            <span class="date-label">{{ $date->translatedFormat('d M Y') }}</span>
            <a href="{{ route('operator.today', ['date' => $date->copy()->addDay()->format('Y-m-d')]) }}">
                <i class="fas fa-chevron-right"></i>
            </a>
        </div>
    </div>

    {{-- SUMMARY --}}
    <div class="summary-row">
        <div class="summary-card">
            <div class="summary-icon total"><i class="fas fa-users"></i></div>
            <div>
                <div class="summary-value">{{ $bookings->count() }}</div>
                <div class="summary-label">Total Booking</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon checked"><i class="fas fa-check-circle"></i></div>
            <div>
                <div class="summary-value">{{ $bookings->where('is_checked_in', true)->count() }}</div>
                <div class="summary-label">Sudah Check-in</div>
            </div>
        </div>

        <div class="summary-card">
            <div class="summary-icon pending"><i class="fas fa-hourglass-half"></i></div>
            <div>
                <div class="summary-value">{{ $bookings->where('is_checked_in', false)->count() }}</div>
                <div class="summary-label">Belum Check-in</div>
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="booking-table-wrap">

        @if($bookings->isEmpty())
            <div class="empty-state">
                <i class="fas fa-calendar-xmark"></i>
                Tidak ada booking terjadwal pada tanggal ini.
            </div>
        @else
            <table class="booking-table">
                <thead>
                    <tr>
                        <th>Kode Booking</th>
                        <th>Wisatawan</th>
                        <th>Paket Wisata</th>
                        <th>Peserta</th>
                        <th>Status</th>
                        <th>Check-in</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($bookings as $booking)
                        <tr>
                            <td class="code-cell">{{ $booking->booking_code }}</td>
                            <td>
                                {{ $booking->user->name ?? '-' }}
                                @if($booking->phone_number)
                                    <div style="font-size:11px;color:#a1a69f;">{{ $booking->phone_number }}</div>
                                @endif
                            </td>
                            <td>{{ $booking->package->name ?? '-' }}</td>
                            <td>{{ $booking->total_people }} orang</td>
                            <td>
                                @if($booking->status === 'Cancelled')
                                    <span class="status-pill cancelled">Dibatalkan</span>
                                @else
                                    <span class="status-pill not-yet">{{ $booking->status }}</span>
                                @endif
                            </td>
                            <td>
                                @if($booking->is_checked_in)
                                    <span class="status-pill checked-in">
                                        <i class="fas fa-check"></i> {{ $booking->checked_in_at->format('H:i') }}
                                    </span>
                                @else
                                    <span class="status-pill not-yet">Belum</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

    </div>

</div>

@endsection