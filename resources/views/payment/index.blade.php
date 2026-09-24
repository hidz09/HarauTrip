@extends('layouts.main')

@section('title','Data Payment')

@section('content')

<style>
    .payment-page {
        background: #f5f1e8;
        min-height: calc(100vh - 57px);
        padding: 28px;
    }

    .payment-card {
        background: #ffffff;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(16, 44, 34, 0.08);
    }

    /* HEADER */
    .payment-header {
        background: #102c22;
        padding: 22px 25px;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .payment-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .payment-header-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: rgba(214, 173, 115, 0.15);
        color: #d6ad73;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 19px;
    }

    .payment-header h3 {
        margin: 0;
        font-size: 22px;
        font-weight: 700;
    }

    .payment-header p {
        margin: 3px 0 0;
        color: #d8dfda;
        font-size: 13px;
    }

    /* BODY */
    .payment-body {
        padding: 25px;
    }

    /* ALERT */
    .payment-alert {
        background: #e8f3e9;
        color: #275c32;
        border: 1px solid #c9dfcc;
        border-radius: 12px;
        padding: 13px 16px;
        margin-bottom: 20px;
        font-size: 14px;
    }

    /* TABLE */
    .table-wrapper {
        width: 100%;
        overflow-x: auto;
        border: 1px solid #e6e0d5;
        border-radius: 14px;
    }

    .payment-table {
        width: 100%;
        margin: 0;
        border-collapse: collapse;
        min-width: 900px;
    }

    .payment-table thead th {
        background: #102c22;
        color: #ffffff;
        border: none;
        padding: 15px 14px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .payment-table tbody td {
        padding: 15px 14px;
        border-top: 1px solid #eee9df;
        color: #26352d;
        font-size: 14px;
        vertical-align: middle;
        background: #ffffff;
    }

    .payment-table tbody tr {
        transition: 0.2s ease;
    }

    .payment-table tbody tr:hover td {
        background: #faf8f3;
    }

    .number-cell {
        color: #7d877f !important;
        font-weight: 600;
        width: 55px;
    }

    .payment-code {
        display: inline-flex;
        align-items: center;
        background: #f1eee7;
        color: #102c22;
        border-radius: 8px;
        padding: 6px 10px;
        font-family: monospace;
        font-size: 12px;
        font-weight: 600;
    }

    .user-name {
        font-weight: 600;
        color: #102c22;
    }

    .package-name {
        color: #59645d;
    }

    .payment-total {
        color: #102c22;
        font-weight: 700;
        white-space: nowrap;
    }

    /* BADGES */
    .payment-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .badge-method {
        background: #e3f0ef;
        color: #2e6e74;
    }

    .badge-lunas {
        background: #e4f2e6;
        color: #32703b;
    }

    .badge-ditolak {
        background: #f8e4e1;
        color: #a64034;
    }

    .badge-pending {
        background: #f7eddc;
        color: #936d2f;
    }

    /* BUTTON */
    .detail-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 7px;
        padding: 8px 13px;
        background: #102c22;
        color: #ffffff !important;
        border-radius: 9px;
        font-size: 12px;
        font-weight: 600;
        text-decoration: none !important;
        transition: 0.2s ease;
        white-space: nowrap;
    }

    .detail-btn:hover {
        background: #1b4434;
        transform: translateY(-1px);
        color: #ffffff !important;
    }

    .detail-btn i {
        color: #d6ad73;
    }

    /* EMPTY */
    .empty-payment {
        padding: 45px 20px !important;
        text-align: center;
        color: #8a918b !important;
    }

    .empty-icon {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        background: #f1eee7;
        color: #a29b8d;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 12px;
        font-size: 21px;
    }

    .empty-payment strong {
        display: block;
        color: #59645d;
        margin-bottom: 4px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {

        .payment-page {
            padding: 15px;
        }

        .payment-header {
            padding: 18px;
        }

        .payment-header h3 {
            font-size: 18px;
        }

        .payment-header p {
            font-size: 12px;
        }

        .payment-body {
            padding: 18px;
        }

        .payment-header-icon {
            width: 40px;
            height: 40px;
        }
    }
</style>


<div class="payment-page">

    <div class="payment-card">

        {{-- HEADER --}}
        <div class="payment-header">

            <div class="payment-header-left">

                <div class="payment-header-icon">
                    <i class="fas fa-money-bill-wave"></i>
                </div>

                <div>
                    <h3>Data Pembayaran</h3>
                    <p>Kelola seluruh data pembayaran booking wisata</p>
                </div>

            </div>

        </div>


        {{-- BODY --}}
        <div class="payment-body">

            {{-- SUCCESS ALERT --}}
            @if(session('success'))

                <div class="payment-alert">
                    <i class="fas fa-check-circle mr-2"></i>
                    {{ session('success') }}
                </div>

            @endif


            {{-- TABLE --}}
            <div class="table-wrapper">

                <table class="payment-table">

                    <thead>

                        <tr>
                            <th>No</th>
                            <th>Kode Payment</th>
                            <th>User</th>
                            <th>Paket</th>
                            <th>Total</th>
                            <th>Metode</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($payments as $payment)

                            <tr>

                                {{-- NO --}}
                                <td class="number-cell">
                                    {{ $loop->iteration }}
                                </td>


                                {{-- KODE PAYMENT --}}
                                <td>

                                    <span class="payment-code">
                                        {{ $payment->payment_code }}
                                    </span>

                                </td>


                                {{-- USER --}}
                                <td>

                                    <span class="user-name">
                                        {{ $payment->booking->user->name ?? '-' }}
                                    </span>

                                </td>


                                {{-- PAKET --}}
                                <td>

                                    <span class="package-name">
                                        {{ $payment->booking->package->name ?? '-' }}
                                    </span>

                                </td>


                                {{-- TOTAL --}}
                                <td>

                                    <span class="payment-total">
                                        Rp {{ number_format($payment->amount,0,',','.') }}
                                    </span>

                                </td>


                                {{-- METODE --}}
                                <td>

                                    <span class="payment-badge badge-method">
                                        {{ $payment->method }}
                                    </span>

                                </td>


                                {{-- STATUS --}}
                                <td>

                                    @if($payment->status == 'Lunas')

                                        <span class="payment-badge badge-lunas">
                                            <i class="fas fa-check-circle mr-1"></i>
                                            Lunas
                                        </span>

                                    @elseif($payment->status == 'Ditolak')

                                        <span class="payment-badge badge-ditolak">
                                            <i class="fas fa-times-circle mr-1"></i>
                                            Ditolak
                                        </span>

                                    @else

                                        <span class="payment-badge badge-pending">
                                            <i class="fas fa-clock mr-1"></i>
                                            Pending
                                        </span>

                                    @endif

                                </td>


                                {{-- AKSI --}}
                                <td>

                                    <a href="{{ route('admin.payment.show',$payment->id) }}"
                                       class="detail-btn">

                                        <i class="fas fa-eye"></i>
                                        Detail

                                    </a>

                                </td>

                            </tr>


                        @empty

                            <tr>

                                <td colspan="8" class="empty-payment">

                                    <div class="empty-icon">
                                        <i class="fas fa-wallet"></i>
                                    </div>

                                    <strong>Belum ada pembayaran</strong>

                                    <span>
                                        Data pembayaran akan muncul di halaman ini.
                                    </span>

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