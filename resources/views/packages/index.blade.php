@extends('layouts.main')

@section('title', 'Paket Wisata')

@section('content')

<style>
    .package-page {
        background: #f5f1e8;
        min-height: calc(100vh - 57px);
        padding: 28px;
    }

    .package-card {
        background: #ffffff;
        border: none;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 8px 25px rgba(16, 44, 34, 0.08);
    }

    /* HEADER */
    .package-header {
        background: #102c22;
        color: #ffffff;
        padding: 21px 25px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
    }

    .package-title {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .package-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;
        background: rgba(214, 173, 115, 0.15);
        color: #d6ad73;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
    }

    .package-title h3 {
        margin: 0;
        font-size: 21px;
        font-weight: 700;
    }

    .package-title p {
        margin: 3px 0 0;
        color: #d8dfda;
        font-size: 13px;
    }

    /* BUTTON TAMBAH */
    .add-package-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #d6ad73;
        color: #102c22 !important;
        padding: 10px 16px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 700;
        text-decoration: none !important;
        transition: 0.2s ease;
    }

    .add-package-btn:hover {
        background: #e2c28f;
        transform: translateY(-1px);
    }

    /* BODY */
    .package-body {
        padding: 25px;
    }

    /* ALERT */
    .package-alert {
        background: #e8f3e9;
        color: #275c32;
        border: 1px solid #c9dfcc;
        border-radius: 11px;
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

    .package-table {
        width: 100%;
        min-width: 950px;
        margin: 0;
        border-collapse: collapse;
    }

    .package-table thead th {
        background: #102c22;
        color: #ffffff;
        border: none;
        padding: 15px 13px;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .package-table tbody td {
        background: #ffffff;
        color: #26352d;
        padding: 15px 13px;
        border-top: 1px solid #eee9df;
        font-size: 14px;
        vertical-align: middle;
    }

    .package-table tbody tr {
        transition: 0.2s ease;
    }

    .package-table tbody tr:hover td {
        background: #faf8f3;
    }

    .number-cell {
        color: #8a918b !important;
        font-weight: 600;
        width: 55px;
    }

    .destination-name {
        color: #59645d;
    }

    .package-name {
        color: #102c22;
        font-weight: 700;
    }

    .price {
        color: #102c22;
        font-weight: 700;
        white-space: nowrap;
    }

    .duration,
    .quota {
        color: #59645d;
        white-space: nowrap;
    }

    /* STATUS */
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 7px 11px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        white-space: nowrap;
    }

    .status-active {
        background: #e4f2e6;
        color: #32703b;
    }

    .status-inactive {
        background: #f8e4e1;
        color: #a64034;
    }

    /* AKSI */
    .action-group {
        display: flex;
        align-items: center;
        gap: 7px;
    }

    .edit-btn,
    .delete-btn {
        width: 34px;
        height: 34px;
        border-radius: 8px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: none;
        transition: 0.2s ease;
    }

    .edit-btn {
        background: #f7eddc;
        color: #936d2f !important;
    }

    .edit-btn:hover {
        background: #d6ad73;
        color: #102c22 !important;
        transform: translateY(-1px);
    }

    .delete-btn {
        background: #f8e4e1;
        color: #a64034;
        cursor: pointer;
    }

    .delete-btn:hover {
        background: #a64034;
        color: #ffffff;
        transform: translateY(-1px);
    }

    /* EMPTY */
    .empty-package {
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

    .empty-package strong {
        display: block;
        color: #59645d;
        margin-bottom: 4px;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {

        .package-page {
            padding: 15px;
        }

        .package-header {
            padding: 18px;
            align-items: flex-start;
            flex-direction: column;
        }

        .package-body {
            padding: 18px;
        }

        .package-title h3 {
            font-size: 18px;
        }

        .package-title p {
            font-size: 12px;
        }

        .add-package-btn {
            width: 100%;
            justify-content: center;
        }
    }
</style>


<div class="package-page">

    <div class="package-card">

        {{-- HEADER --}}
        <div class="package-header">

            <div class="package-title">

                <div class="package-icon">
                    <i class="fas fa-map-marked-alt"></i>
                </div>

                <div>

                    <h3>Data Paket Wisata</h3>

                    <p>
                        Kelola paket wisata yang tersedia di Harau Trip
                    </p>

                </div>

            </div>


            {{-- TAMBAH PAKET --}}
            <a href="{{ route('admin.package.create') }}"
               class="add-package-btn">

                <i class="fas fa-plus"></i>

                Tambah Paket

            </a>

        </div>


        {{-- BODY --}}
        <div class="package-body">

            {{-- SUCCESS --}}
            @if(session('success'))

                <div class="package-alert">

                    <i class="fas fa-check-circle mr-2"></i>

                    {{ session('success') }}

                </div>

            @endif


            {{-- TABLE --}}
            <div class="table-wrapper">

                <table class="package-table">

                    <thead>

                        <tr>

                            <th>No</th>
                            <th>Destinasi</th>
                            <th>Nama Paket</th>
                            <th>Harga</th>
                            <th>Durasi</th>
                            <th>Kuota</th>
                            <th>Status</th>
                            <th>Aksi</th>

                        </tr>

                    </thead>


                    <tbody>

                    @forelse($packages as $package)

                        <tr>

                            {{-- NO --}}
                            <td class="number-cell">

                                {{ $loop->iteration }}

                            </td>


                            {{-- DESTINASI --}}
                            <td>

                                <span class="destination-name">

                                    {{ $package->destination->name ?? '-' }}

                                </span>

                            </td>


                            {{-- NAMA PAKET --}}
                            <td>

                                <span class="package-name">

                                    {{ $package->name }}

                                </span>

                            </td>


                            {{-- HARGA --}}
                            <td>

                                <span class="price">

                                    Rp {{ number_format($package->price,0,',','.') }}

                                </span>

                            </td>


                            {{-- DURASI --}}
                            <td>

                                <span class="duration">

                                    {{ $package->duration_days }} Hari

                                </span>

                            </td>


                            {{-- KUOTA --}}
                            <td>

                                <span class="quota">

                                    {{ $package->quota }} Orang

                                </span>

                            </td>


                            {{-- STATUS --}}
                            <td>

                                @if($package->status == 'active')

                                    <span class="status-badge status-active">

                                        <i class="fas fa-check-circle"></i>

                                        Active

                                    </span>

                                @else

                                    <span class="status-badge status-inactive">

                                        <i class="fas fa-times-circle"></i>

                                        Inactive

                                    </span>

                                @endif

                            </td>


                            {{-- AKSI --}}
                            <td>

                                <div class="action-group">

                                    {{-- EDIT --}}
                                    <a href="{{ route('admin.package.edit',$package->id) }}"
                                       class="edit-btn"
                                       title="Edit Paket">

                                        <i class="fas fa-edit"></i>

                                    </a>


                                    {{-- DELETE --}}
                                    <form action="{{ route('admin.package.delete',$package->id) }}"
                                          method="POST"
                                          style="display:inline"
                                          onsubmit="return confirm('Yakin ingin menghapus paket ini?')">

                                        @csrf

                                        @method('DELETE')

                                        <button type="submit"
                                                class="delete-btn"
                                                title="Hapus Paket">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </div>

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td colspan="8" class="empty-package">

                                <div class="empty-icon">

                                    <i class="fas fa-box-open"></i>

                                </div>

                                <strong>

                                    Belum ada data paket wisata

                                </strong>

                                <span>

                                    Tambahkan paket wisata untuk menampilkannya di halaman ini.

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