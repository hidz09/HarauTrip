@extends('layouts.main')

@section('title', 'Edit Paket Wisata')

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

    /* KEMBALI */
    .back-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: rgba(255,255,255,0.08);
        border: 1px solid rgba(255,255,255,0.25);
        color: #ffffff !important;
        padding: 9px 15px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none !important;
        transition: 0.2s ease;
    }

    .back-btn:hover {
        background: #d6ad73;
        border-color: #d6ad73;
        color: #102c22 !important;
    }

    /* BODY */
    .package-body {
        padding: 30px;
    }

    /* FORM */
    .form-group {
        margin-bottom: 22px;
    }

    .form-group label {
        color: #102c22;
        font-size: 13px;
        font-weight: 700;
        margin-bottom: 8px;
        display: block;
    }

    .form-control {
        height: 44px;
        border: 1px solid #ddd8ce;
        border-radius: 9px;
        background: #ffffff;
        color: #26352d;
        font-size: 14px;
        padding: 10px 13px;
        transition: 0.2s ease;
        box-shadow: none !important;
    }

    textarea.form-control {
        height: auto;
        min-height: 115px;
        resize: vertical;
    }

    .form-control:focus {
        border-color: #4c7a4c;
        box-shadow: 0 0 0 3px rgba(76, 122, 76, 0.10) !important;
    }

    .form-control::placeholder {
        color: #a1a69f;
    }

    select.form-control {
        cursor: pointer;
    }

    /* ERROR */
    .form-control.is-invalid {
        border-color: #c75a4d;
    }

    .invalid-feedback {
        color: #b04438;
        font-size: 12px;
        margin-top: 6px;
    }

    /* FORM ROW */
    .form-row {
        display: flex;
        margin-right: -10px;
        margin-left: -10px;
    }

    .form-row > .form-group {
        padding-right: 10px;
        padding-left: 10px;
    }

    /* BUTTON */
    .form-actions {
        border-top: 1px solid #eee9df;
        margin-top: 28px;
        padding-top: 23px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .update-btn {
        border: none;
        background: #102c22;
        color: #ffffff !important;
        padding: 11px 19px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        cursor: pointer;
        transition: 0.2s ease;
    }

    .update-btn:hover {
        background: #1b4434;
        transform: translateY(-1px);
    }

    .update-btn i {
        color: #d6ad73;
        margin-right: 5px;
    }

    .cancel-btn {
        background: #f1eee7;
        color: #59645d !important;
        border: 1px solid #ddd8ce;
        padding: 10px 18px;
        border-radius: 9px;
        font-size: 13px;
        font-weight: 600;
        text-decoration: none !important;
        transition: 0.2s ease;
    }

    .cancel-btn:hover {
        background: #e6e1d7;
        color: #102c22 !important;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {

        .package-page {
            padding: 15px;
        }

        .package-header {
            padding: 18px;
            align-items: flex-start;
        }

        .package-title h3 {
            font-size: 18px;
        }

        .package-title p {
            font-size: 12px;
        }

        .back-btn {
            padding: 8px 11px;
        }

        .package-body {
            padding: 20px;
        }

        .form-row {
            display: block;
            margin-left: 0;
            margin-right: 0;
        }

        .form-row > .form-group {
            padding-left: 0;
            padding-right: 0;
        }

        .form-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .update-btn,
        .cancel-btn {
            width: 100%;
            text-align: center;
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
                    <i class="fas fa-edit"></i>
                </div>

                <div>

                    <h3>Edit Paket Wisata</h3>

                    <p>
                        Perbarui informasi paket wisata Harau Trip
                    </p>

                </div>

            </div>


            <a href="{{ route('admin.package.index') }}"
               class="back-btn">

                <i class="fas fa-arrow-left"></i>

                Kembali

            </a>

        </div>


        {{-- BODY --}}
        <div class="package-body">

            <form action="{{ route('admin.package.update', $package->id) }}"
                  method="POST">

                @csrf
                @method('PUT')


                {{-- DESTINASI --}}
                <div class="form-group">

                    <label>
                        Destinasi Wisata
                    </label>

                    <select name="destination_id"
                            class="form-control @error('destination_id') is-invalid @enderror"
                            required>

                        <option value="">
                            -- Pilih Destinasi --
                        </option>

                        @foreach ($destinations as $destination)

                            <option value="{{ $destination->id }}"
                                {{ old('destination_id', $package->destination_id) == $destination->id ? 'selected' : '' }}>

                                {{ $destination->name }}

                            </option>

                        @endforeach

                    </select>


                    @error('destination_id')

                        <span class="invalid-feedback d-block">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- NAMA PAKET + KATEGORI --}}
                <div class="form-row">

                    <div class="form-group col-md-6">

                        <label>
                            Nama Paket
                        </label>

                        <input type="text"
                               name="name"
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $package->name) }}"
                               placeholder="Contoh: Paket Lembah Harau"
                               required>


                        @error('name')

                            <span class="invalid-feedback d-block">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>

                    <div class="form-group col-md-6">

                        <label>
                            Kategori
                        </label>

                        <input type="text"
                               name="category"
                               class="form-control @error('category') is-invalid @enderror"
                               value="{{ old('category', $package->category) }}"
                               placeholder="Contoh: Paket Hemat / Paket Keluarga"
                               required>


                        @error('category')

                            <span class="invalid-feedback d-block">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>

                </div>


                {{-- DESKRIPSI --}}
                <div class="form-group">

                    <label>
                        Deskripsi
                    </label>

                    <textarea name="description"
                              class="form-control @error('description') is-invalid @enderror"
                              rows="4"
                              placeholder="Masukkan deskripsi paket wisata...">{{ old('description', $package->description) }}</textarea>


                    @error('description')

                        <span class="invalid-feedback d-block">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- HARGA + DURASI --}}
                <div class="form-row">

                    {{-- HARGA --}}
                    <div class="form-group col-md-6">

                        <label>
                            Harga Paket (Rp)
                        </label>

                        <input type="number"
                               name="price"
                               class="form-control @error('price') is-invalid @enderror"
                               value="{{ old('price', $package->price) }}"
                               min="0"
                               required>


                        @error('price')

                            <span class="invalid-feedback d-block">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>


                    {{-- DURASI --}}
                    <div class="form-group col-md-6">

                        <label>
                            Durasi (Hari)
                        </label>

                        <input type="number"
                               name="duration_days"
                               class="form-control @error('duration_days') is-invalid @enderror"
                               value="{{ old('duration_days', $package->duration_days) }}"
                               min="1"
                               required>


                        @error('duration_days')

                            <span class="invalid-feedback d-block">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>

                </div>


                {{-- KUOTA + TANGGAL --}}
                <div class="form-row">

                    {{-- KUOTA --}}
                    <div class="form-group col-md-6">

                        <label>
                            Kuota Peserta
                        </label>

                        <input type="number"
                               name="quota"
                               class="form-control @error('quota') is-invalid @enderror"
                               value="{{ old('quota', $package->quota) }}"
                               min="1"
                               required>


                        @error('quota')

                            <span class="invalid-feedback d-block">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>


                    {{-- TANGGAL --}}
                    <div class="form-group col-md-6">

                        <label>
                            Tanggal Keberangkatan
                        </label>

                        <input type="date"
                               name="departure_date"
                               class="form-control @error('departure_date') is-invalid @enderror"
                               value="{{ old('departure_date', optional($package->departure_date)->format('Y-m-d')) }}">


                        @error('departure_date')

                            <span class="invalid-feedback d-block">
                                {{ $message }}
                            </span>

                        @enderror

                    </div>

                </div>


                {{-- STATUS --}}
                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select name="status"
                            class="form-control @error('status') is-invalid @enderror">

                        <option value="active"
                            {{ old('status', $package->status) === 'active' ? 'selected' : '' }}>

                            Active

                        </option>

                        <option value="inactive"
                            {{ old('status', $package->status) === 'inactive' ? 'selected' : '' }}>

                            Inactive

                        </option>

                    </select>


                    @error('status')

                        <span class="invalid-feedback d-block">
                            {{ $message }}
                        </span>

                    @enderror

                </div>


                {{-- BUTTON --}}
                <div class="form-actions">

                    <button type="submit"
                            class="update-btn">

                        <i class="fas fa-save"></i>

                        Update Paket

                    </button>


                    <a href="{{ route('admin.package.index') }}"
                       class="cancel-btn">

                        Batal

                    </a>

                </div>


            </form>

        </div>

    </div>

</div>

@endsection