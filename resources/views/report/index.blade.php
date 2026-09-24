@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')

<style>
    .report-page{
        background:#f5f1e8;
        min-height:calc(100vh - 57px);
        padding:25px;
    }

    /* STAT CARDS */
    .stat-card{
        background:#ffffff;
        border-radius:16px;
        padding:20px;
        display:flex;
        align-items:center;
        justify-content:space-between;
        box-shadow:0 6px 20px rgba(16,44,34,.06);
        height:100%;
        border-left:4px solid transparent;
    }

    .stat-card .stat-label{
        font-size:12.5px;
        color:#68736d;
        font-weight:600;
        margin:0 0 6px;
        text-transform:uppercase;
        letter-spacing:.03em;
    }

    .stat-card .stat-value{
        font-size:23px;
        font-weight:700;
        color:#1c2a22;
        margin:0;
        line-height:1.2;
    }

    .stat-card .stat-icon{
        width:46px;
        height:46px;
        border-radius:12px;
        display:flex;
        align-items:center;
        justify-content:center;
        font-size:18px;
        flex-shrink:0;
    }

    .stat-card.stat-destination{border-left-color:#4c7a4c}
    .stat-card.stat-destination .stat-icon{
        background:#e8f5ec;
        color:#28733f
    }

    .stat-card.stat-package{border-left-color:#a4773c}
    .stat-card.stat-package .stat-icon{
        background:#f6ead6;
        color:#9a6f35
    }

    .stat-card.stat-booking{border-left-color:#3c6ea4}
    .stat-card.stat-booking .stat-icon{
        background:#e4eef9;
        color:#2c5a8a
    }

    .stat-card.stat-income{border-left-color:#d6ad73}
    .stat-card.stat-income .stat-icon{
        background:#faf1de;
        color:#a4773c
    }

    .stat-card.stat-income .stat-value{
        font-size:18px;
        white-space:nowrap;
    }

    /* GRAPH CARD */
    .chart-card{
        background:#ffffff;
        border:none;
        border-radius:18px;
        box-shadow:0 8px 30px rgba(16,44,34,.08);
        overflow:hidden;
        margin-top:22px;
    }

    .chart-header{
        background:#102c22;
        color:#ffffff;
        padding:18px 25px;
    }

    .chart-header h3{
        margin:0;
        font-family:Georgia,serif;
        font-weight:700;
        font-size:20px;
    }

    .chart-header small{
        color:#d6ad73;
        font-size:12.5px;
    }

    .chart-body{
        padding:25px;
        height:350px;
        position:relative;
    }

    /* REPORT CARD */
    .report-card{
        background:#ffffff;
        border:none;
        border-radius:18px;
        box-shadow:0 8px 30px rgba(16,44,34,.08);
        overflow:hidden;
        margin-top:22px;
    }

    .report-header{
        background:#102c22;
        color:#ffffff;
        padding:18px 25px;
    }

    .report-header h3{
        margin:0;
        font-family:Georgia,serif;
        font-weight:700;
        font-size:20px;
    }

    .report-header small{
        color:#d6ad73;
        font-size:12.5px;
    }

    .report-body{
        padding:25px
    }

    .report-table-wrapper{
        overflow-x:auto;
        border-radius:12px;
        border:1px solid #e7e1d6;
    }

    .report-table{
        width:100%;
        margin:0;
        border-collapse:collapse;
        background:#fff;
    }

    .report-table thead{
        background:#102c22;
        color:#fff;
    }

    .report-table thead th{
        padding:13px 12px;
        border:none;
        font-size:12.5px;
        font-weight:600;
        white-space:nowrap;
    }

    .report-table tbody td{
        padding:12px;
        vertical-align:middle;
        border-top:1px solid #eee8dc;
        color:#39443e;
        font-size:13.5px;
    }

    .report-table tbody tr:hover{
        background:#faf7f0
    }

    .report-code{
        color:#102c22;
        font-weight:700
    }

    .report-price{
        color:#a4773c;
        font-weight:700;
        white-space:nowrap
    }

    .status-badge{
        display:inline-block;
        padding:5px 11px;
        border-radius:20px;
        font-size:11.5px;
        font-weight:600;
    }

    .status-done{
        background:#d5e8d9;
        color:#24613a
    }

    .status-confirmed{
        background:#dfece6;
        color:#235641
    }

    .status-other{
        background:#f8ead0;
        color:#956b2f
    }

    .empty-report{
        padding:40px 20px !important;
        text-align:center;
        color:#8b8b82 !important;
    }

    @media (max-width:768px){
        .report-page{
            padding:15px
        }

        .stat-card{
            margin-bottom:14px
        }

        .report-body{
            padding:15px
        }

        .chart-body{
            height:280px;
            padding:15px
        }
    }
</style>

<div class="report-page">

{{-- Statistik --}}
<div class="row">

    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="stat-card stat-destination">
            <div>
                <p class="stat-label">Destinasi</p>
                <h3 class="stat-value">{{ $totalDestination }}</h3>
            </div>

            <div class="stat-icon">
                <i class="fas fa-map-marked-alt"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6 mb-3 mb-lg-0">
        <div class="stat-card stat-package">
            <div>
                <p class="stat-label">Paket Wisata</p>
                <h3 class="stat-value">{{ $totalPackage }}</h3>
            </div>

            <div class="stat-icon">
                <i class="fas fa-suitcase"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="stat-card stat-booking">
            <div>
                <p class="stat-label">Total Booking</p>
                <h3 class="stat-value">{{ $totalBooking }}</h3>
            </div>

            <div class="stat-icon">
                <i class="fas fa-calendar-check"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-6">
        <div class="stat-card stat-income">
            <div>
                <p class="stat-label">Pendapatan</p>
                <h3 class="stat-value">
                    Rp {{ number_format($totalIncome,0,',','.') }}
                </h3>
            </div>

            <div class="stat-icon">
                <i class="fas fa-money-bill-wave"></i>
            </div>
        </div>
    </div>

</div>


{{-- Tabel Laporan --}}
<div class="report-card">

    <div class="report-header">
        <h3>Laporan Booking</h3>
        <small>Ringkasan seluruh transaksi booking</small>
    </div>

    <div class="report-body">

        <div class="report-table-wrapper">

            <table class="report-table">

                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th>Kode Booking</th>
                        <th>User</th>
                        <th>Paket</th>
                        <th>Tanggal</th>
                        <th>Jumlah Orang</th>
                        <th>Total</th>
                        <th>Status</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($bookings as $booking)

                        <tr>

                            <td>{{ $loop->iteration }}</td>

                            <td>
                                <span class="report-code">
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
                                <span class="report-price">
                                    Rp {{ number_format($booking->total_price,0,',','.') }}
                                </span>
                            </td>

                            <td>

                                @if($booking->status == 'Selesai')

                                    <span class="status-badge status-done">
                                        Selesai
                                    </span>

                                @elseif($booking->status == 'Dikonfirmasi')

                                    <span class="status-badge status-confirmed">
                                        Dikonfirmasi
                                    </span>

                                @else

                                    <span class="status-badge status-other">
                                        {{ $booking->status }}
                                    </span>

                                @endif

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td colspan="8" class="empty-report">

                                <i class="fas fa-calendar-check d-block mb-2"
                                   style="font-size:32px;color:#d6ad73"></i>

                                Belum ada data booking

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</div>

{{-- Grafik Penjualan --}}
<div class="chart-card">

    <div class="chart-header">
        <h3>Grafik Penjualan</h3>
        <small>Ringkasan pendapatan berdasarkan tanggal booking</small>
    </div>

    <div class="chart-body">
        <canvas id="salesChart"></canvas>
    </div>

</div>

</div>

{{-- Chart.js --}}

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

    const bookingData = @json(
        $bookings->map(function($booking) {
            return [
                'date' => $booking->booking_date->format('d-m-Y'),
                'total' => (float) $booking->total_price
            ];
        })
    );

    // Mengelompokkan pendapatan berdasarkan tanggal
    const salesData = {};

    bookingData.forEach(function(booking) {

        if (!salesData[booking.date]) {
            salesData[booking.date] = 0;
        }

        salesData[booking.date] += booking.total;

    });

    const labels = Object.keys(salesData);

    const values = Object.values(salesData);


    const ctx = document.getElementById('salesChart').getContext('2d');

    new Chart(ctx, {

        type: 'line',

        data: {

            labels: labels,

            datasets: [{

                label: 'Pendapatan',

                data: values,

                borderWidth: 3,

                tension: 0.35,

                fill: true,

                pointRadius: 4,

                pointHoverRadius: 6

            }]

        },

        options: {

            responsive: true,

            maintainAspectRatio: false,

            plugins: {

                legend: {
                    display: true
                },

                tooltip: {

                    callbacks: {

                        label: function(context) {

                            return 'Rp ' +
                                new Intl.NumberFormat('id-ID').format(context.raw);

                        }

                    }

                }

            },

            scales: {

                y: {

                    beginAtZero: true,

                    ticks: {

                        callback: function(value) {

                            return 'Rp ' +
                                new Intl.NumberFormat('id-ID').format(value);

                        }

                    }

                },

                x: {

                    grid: {
                        display: false
                    }

                }

            }

        }

    });

</script>

@endsection
