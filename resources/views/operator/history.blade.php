@extends('layouts.operator')

@section('title', 'Riwayat Check-in')

@section('content')

<style>
    .history-page {
        padding: 28px;
    }

    .history-header {
        margin-bottom: 20px;
    }

    .history-header h2 {
        margin: 0;
        font-size: 20px;
        font-weight: 700;
        color: #102c22;
    }

    .history-header p {
        margin: 3px 0 0;
        font-size: 13px;
        color: #7a8580;
    }

    /* FILTER BAR */
    .filter-bar {
        background: #ffffff;
        border-radius: 14px;
        padding: 16px 18px;
        box-shadow: 0 4px 16px rgba(16, 44, 34, 0.06);
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: flex-end;
    }

    .filter-group {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }

    .filter-group label {
        font-size: 11px;
        font-weight: 700;
        color: #59645d;
        text-transform: uppercase;
        letter-spacing: 0.03em;
    }

    .filter-group input {
        border: 1px solid #ddd8ce;
        border-radius: 8px;
        padding: 8px 12px;
        font-size: 13px;
        height: 38px;
    }

    .filter-group input:focus {
        outline: none;
        border-color: #4c7a4c;
        box-shadow: 0 0 0 3px rgba(76, 122, 76, 0.10);
    }

    .filter-search {
        flex: 1;
        min-width: 200px;
    }

    .filter-btn {
        height: 38px;
        border: none;
        background: #102c22;
        color: #ffffff;
        padding: 0 18px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 600;
    }

    .filter-btn:hover {
        background: #1b4434;
    }

    .filter-reset {
        height: 38px;
        border: 1px solid #ddd8ce;
        background: #f8f6f0;
        color: #59645d;
        padding: 0 16px;
        border-radius: 8px;
        font-size: 12.5px;
        font-weight: 600;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
    }

    .filter-reset:hover {
        background: #eee9df;
        color: #26332b;
    }

    /* TABLE */
    .history-table-wrap {
        background: #ffffff;
        border-radius: 16px;
        overflow: hidden;
        box-shadow: 0 4px 16px rgba(16, 44, 34, 0.06);
    }

    table.history-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 13px;
    }

    table.history-table thead th {
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

    table.history-table tbody td {
        padding: 14px 18px;
        border-bottom: 1px solid #f3f0e8;
        color: #26332b;
        vertical-align: middle;
    }

    table.history-table tbody tr:last-child td {
        border-bottom: none;
    }

    table.history-table tbody tr:hover {
        background: #fbfaf6;
    }

    .code-cell {
        font-family: "Courier New", monospace;
        font-weight: 700;
        color: #102c22;
    }

    .checkin-time {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
        color: #2b8a52;
    }

    .operator-chip {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #59645d;
    }

    .operator-chip .chip-avatar {
        width: 22px;
        height: 22px;
        border-radius: 50%;
        background: #102c22;
        color: #d6ad73;
        font-size: 10px;
        font-weight: 700;
        display: flex;
        align-items: center;
        justify-content: center;
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

    .pagination-wrap {
        padding: 16px 18px;
        border-top: 1px solid #f3f0e8;
    }

    @media (max-width: 900px) {
        .history-table-wrap {
            overflow-x: auto;
        }

        table.history-table {
            min-width: 750px;
        }
    }
</style>

<div class="history-page">

    <div class="history-header">
        <h2>Riwayat Check-in</h2>
        <p>Daftar booking yang sudah pernah discan / diverifikasi</p>
    </div>

    {{-- FILTER --}}
    <form method="GET" action="{{ route('operator.history') }}" class="filter-bar">

        <div class="filter-group filter-search">
            <label>Cari</label>
            <input type="text" name="search" value="{{ request('search') }}"
                   placeholder="Kode booking atau nama wisatawan...">
        </div>

        <div class="filter-group">
            <label>Dari Tanggal</label>
            <input type="date" name="from" value="{{ request('from') }}">
        </div>

        <div class="filter-group">
            <label>Sampai Tanggal</label>
            <input type="date" name="to" value="{{ request('to') }}">
        </div>

        <button type="submit" class="filter-btn">
            <i class="fas fa-filter"></i> Filter
        </button>

        @if(request('search') || request('from') || request('to'))
            <a href="{{ route('operator.history') }}" class="filter-reset">
                <i class="fas fa-times"></i> Reset
            </a>
        @endif

    </form>

    {{-- TABLE --}}
    <div class="history-table-wrap">

        @if($history->isEmpty())
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                Belum ada riwayat check-in yang cocok.
            </div>
        @else
            <table class="history-table">
                <thead>
                    <tr>
                        <th>Kode Booking</th>
                        <th>Wisatawan</th>
                        <th>Paket Wisata</th>
                        <th>Waktu Check-in</th>
                        <th>Discan Oleh</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($history as $booking)
                        <tr>
                            <td class="code-cell">{{ $booking->booking_code }}</td>
                            <td>{{ $booking->user->name ?? '-' }}</td>
                            <td>{{ $booking->package->name ?? '-' }}</td>
                            <td>
                                <span class="checkin-time">
                                    <i class="fas fa-check-circle"></i>
                                    {{ $booking->checked_in_at->translatedFormat('d M Y, H:i') }}
                                </span>
                            </td>
                            <td>
                                @if($booking->checkedInBy)
                                    <span class="operator-chip">
                                        <span class="chip-avatar">
                                            {{ strtoupper(substr($booking->checkedInBy->name, 0, 1)) }}
                                        </span>
                                        {{ $booking->checkedInBy->name }}
                                    </span>
                                @else
                                    <span style="color:#a1a69f;">-</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="pagination-wrap">
                {{ $history->links() }}
            </div>
        @endif

    </div>

</div>

@endsection