@extends('layouts.main')

@section('title', 'Detail Pembayaran')

@section('content')

<style>
    .detail-payment-page {
        background: #f5f1e8;
        min-height: calc(100vh - 57px);
        padding: 25px;
    }

    .detail-payment-card {
        background: #ffffff;
        border: none;
        border-radius: 18px;
        box-shadow: 0 8px 30px rgba(16, 44, 34, 0.08);
        overflow: hidden;
        max-width: 1000px;
        margin: 0 auto;
    }

    /* HEADER */
    .detail-payment-header {
        background: #102c22;
        color: #ffffff;
        padding: 20px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .detail-payment-header h3 {
        margin: 0;
        font-family: Georgia, serif;
        font-weight: 700;
        font-size: 24px;
    }

    .detail-payment-header small {
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
    .detail-payment-body {
        padding: 30px;
    }

    /* ALERT */
    .payment-alert {
        background: #e8f1ec;
        border: 1px solid #bfd5c9;
        color: #102c22;
        border-radius: 10px;
        padding: 12px 16px;
        margin-bottom: 20px;
    }

    /* TABLE */
    .payment-detail-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        border: 1px solid #e7e1d6;
        border-radius: 12px;
        overflow: hidden;
    }

    .payment-detail-table tr:hover {
        background: #faf7f0;
    }

    .payment-detail-table th {
        width: 30%;
        background: #f7f3eb;
        color: #102c22;
        font-weight: 600;
        padding: 15px 18px;
        border-bottom: 1px solid #e7e1d6;
        font-size: 14px;
        vertical-align: middle;
    }

    .payment-detail-table td {
        color: #4b534e;
        padding: 15px 18px;
        border-bottom: 1px solid #e7e1d6;
        font-size: 14px;
        vertical-align: middle;
    }

    .payment-detail-table tr:last-child th,
    .payment-detail-table tr:last-child td {
        border-bottom: none;
    }

    /* KODE */
    .payment-code {
        display: inline-block;
        background: #e8f0eb;
        color: #174a37;
        padding: 6px 10px;
        border-radius: 7px;
        font-weight: 700;
        letter-spacing: 0.3px;
    }

    .booking-code {
        color: #174a37;
        font-weight: 600;
    }

    /* HARGA */
    .payment-price {
        color: #9a6f35;
        font-size: 17px;
        font-weight: 700;
    }

    /* METHOD */
    .method-badge {
        display: inline-block;
        background: #e6eeee;
        color: #2e6e74;
        padding: 6px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
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

    .status-lunas {
        background: #d5e8d9;
        color: #24613a;
    }

    .status-ditolak {
        background: #f2dddd;
        color: #a33d3d;
    }

    /* BUKTI PEMBAYARAN */
    .proof-wrapper {
        margin-top: 5px;
    }

    .proof-image {
        max-width: 320px;
        max-height: 350px;
        object-fit: contain;
        border-radius: 10px;
        border: 1px solid #ddd7ca;
        padding: 5px;
        background: #faf7f0;
        transition: 0.2s;
    }

    .proof-image:hover {
        transform: scale(1.01);
        box-shadow: 0 5px 20px rgba(16, 44, 34, 0.12);
    }

    .proof-text {
        color: #8b8b82;
        font-size: 12px;
        margin-top: 8px;
    }

    /* PEMBATAS */
    .payment-divider {
        border: 0;
        border-top: 1px solid #e7e1d6;
        margin: 30px 0;
    }

    /* UBAH STATUS */
    .status-section-title {
        color: #102c22;
        font-family: Georgia, serif;
        font-weight: 700;
        font-size: 19px;
        margin-bottom: 15px;
    }

    .status-form {
        background: #faf7f0;
        border: 1px solid #e7e1d6;
        border-radius: 12px;
        padding: 20px;
    }

    .status-form label {
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
        box-shadow: none;
    }

    .form-control:focus {
        border-color: #d6ad73;
        box-shadow: 0 0 0 3px rgba(214, 173, 115, 0.15);
    }

    /* BUTTON SIMPAN */
    .btn-save-status {
        background: #102c22;
        color: #ffffff !important;
        border: none;
        border-radius: 9px;
        padding: 10px 18px;
        font-weight: 600;
        transition: 0.2s;
    }

    .btn-save-status:hover {
        background: #1b4738;
        color: #ffffff !important;
        transform: translateY(-1px);
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {

        .detail-payment-page {
            padding: 15px;
        }

        .detail-payment-header {
            flex-direction: column;
            align-items: flex-start;
            gap: 15px;
        }

        .detail-payment-header .btn-back {
            width: 100%;
            text-align: center;
        }

        .detail-payment-body {
            padding: 20px;
        }

        .payment-detail-table th {
            width: 40%;
        }

        .payment-detail-table th,
        .payment-detail-table td {
            padding: 12px;
        }

        .proof-image {
            max-width: 100%;
        }
    }
</style>


<div class="detail-payment-page">

    <div class="detail-payment-card">

        {{-- HEADER --}}
        <div class="detail-payment-header">

            <div>
                <h3>Detail Pembayaran</h3>
                <small>Informasi lengkap pembayaran booking</small>
            </div>

            <a href="{{ route('admin.payment.index') }}"
               class="btn btn-back">

                <i class="fas fa-arrow-left mr-1"></i>
                Kembali

            </a>

        </div>


        {{-- BODY --}}
        <div class="detail-payment-body">

            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="payment-alert">

                    <i class="fas fa-check-circle mr-1"></i>

                    {{ session('success') }}

                </div>

            @endif


            {{-- DETAIL PEMBAYARAN --}}
            <table class="payment-detail-table">

                <tr>
                    <th>Kode Payment</th>

                    <td>
                        <span class="payment-code">
                            {{ $payment->payment_code }}
                        </span>
                    </td>
                </tr>


                <tr>
                    <th>Kode Booking</th>

                    <td>
                        <span class="booking-code">
                            {{ $payment->booking->booking_code ?? '-' }}
                        </span>
                    </td>
                </tr>


                <tr>
                    <th>User</th>

                    <td>
                        {{ $payment->booking->user->name ?? '-' }}
                    </td>
                </tr>


                <tr>
                    <th>Paket Wisata</th>

                    <td>
                        {{ $payment->booking->package->name ?? '-' }}
                    </td>
                </tr>


                <tr>
                    <th>Jumlah</th>

                    <td>
                        <span class="payment-price">
                            Rp {{ number_format($payment->amount, 0, ',', '.') }}
                        </span>
                    </td>
                </tr>


                <tr>
                    <th>Metode</th>

                    <td>
                        <span class="method-badge">
                            {{ $payment->method }}
                        </span>
                    </td>
                </tr>


                <tr>
                    <th>Status Saat Ini</th>

                    <td>

                        @if($payment->status == 'Lunas')

                            <span class="status-badge status-lunas">
                                Lunas
                            </span>

                        @elseif($payment->status == 'Ditolak')

                            <span class="status-badge status-ditolak">
                                Ditolak
                            </span>

                        @else

                            <span class="status-badge status-pending">
                                Pending
                            </span>

                        @endif

                    </td>
                </tr>


                <tr>
                    <th>Bukti Pembayaran</th>

                    <td>

                        @if($payment->proof)

                            <div class="proof-wrapper">

                                <a href="{{ asset('storage/' . $payment->proof) }}"
                                   target="_blank">

                                    <img
                                        src="{{ asset('storage/' . $payment->proof) }}"
                                        alt="Bukti Pembayaran"
                                        class="proof-image">

                                </a>

                                <div class="proof-text">

                                    <i class="fas fa-search-plus mr-1"></i>
                                    Klik gambar untuk memperbesar

                                </div>

                            </div>

                        @else

                            <span class="proof-text">
                                <i class="fas fa-image mr-1"></i>
                                Tidak ada bukti pembayaran
                            </span>

                        @endif

                    </td>

                </tr>

            </table>


            {{-- UBAH STATUS --}}
            <hr class="payment-divider">


            <h5 class="status-section-title">
                Ubah Status Pembayaran
            </h5>


            <div class="status-form">

                <form
                    action="{{ route('admin.payment.update', $payment->id) }}"
                    method="POST">

                    @csrf
                    @method('PUT')


                    <div class="form-group">

                        <label>
                            Status Pembayaran
                        </label>

                        <select
                            name="status"
                            class="form-control"
                            required>

                            <option value="Pending"
                                {{ $payment->status == 'Pending' ? 'selected' : '' }}>
                                Pending
                            </option>

                            <option value="Lunas"
                                {{ $payment->status == 'Lunas' ? 'selected' : '' }}>
                                Lunas
                            </option>

                            <option value="Ditolak"
                                {{ $payment->status == 'Ditolak' ? 'selected' : '' }}>
                                Ditolak
                            </option>

                        </select>

                    </div>


                    <button type="submit"
                            class="btn btn-save-status">

                        <i class="fas fa-save mr-1"></i>
                        Simpan Status

                    </button>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection