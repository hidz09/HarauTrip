@extends('layouts.main')

@section('title', 'Tambah Paket Wisata')

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
        resize: vertical;
        min-height: 115px;
    }

    .form-control:focus {
        border-color: #4c7a4c;
        box-shadow: 0 0 0 3px rgba(76, 122, 76, 0.10) !important;
    }

    .form-control::placeholder {
        color: #a1a69f;
    }

    .form-control[readonly] {
        background: #f7f5ef;
        color: #59645d;
        cursor: not-allowed;
    }

    select.form-control {
        cursor: pointer;
    }

    /* INPUT GROUP */
    .input-group {
        display: flex;
    }

    .input-group-prepend {
        display: flex;
    }

    .input-group-text {
        background: #102c22;
        color: #d6ad73;
        border: 1px solid #102c22;
        border-radius: 9px 0 0 9px;
        padding: 0 15px;
        font-weight: 700;
        font-size: 13px;
    }

    .input-group .form-control {
        border-radius: 0 9px 9px 0;
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

    .save-btn {
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

    .save-btn:hover {
        background: #1b4434;
        transform: translateY(-1px);
    }

    .save-btn i {
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

        .save-btn,
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
                    <i class="fas fa-plus"></i>
                </div>

                <div>

                    <h3>Tambah Paket Wisata</h3>

                    <p>
                        Tambahkan paket wisata baru ke Harau Trip
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

            <form action="{{ route('admin.package.store') }}" method="POST">

                @csrf


                {{-- DESTINASI --}}
                <div class="form-group">

                    <label>
                        Destinasi Wisata
                    </label>

                    <select name="destination_id"
                            id="destination_id"
                            class="form-control"
                            required>

                        <option value="">
                            -- Pilih Destinasi --
                        </option>

                        @foreach($destinations as $destination)

                            <option value="{{ $destination->id }}">

                                {{ $destination->name }}

                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- KATEGORI (otomatis terisi dari destinasi) --}}
                <div class="form-group">

                    <label>
                        Kategori
                    </label>

                    <input type="text"
                           name="category"
                           id="category"
                           class="form-control"
                           placeholder="Otomatis terisi setelah pilih destinasi"
                           readonly
                           required>

                </div>


                {{-- NAMA PAKET --}}
                <div class="form-group">

                    <label>
                        Nama Paket
                    </label>

                    <input type="text"
                           name="name"
                           class="form-control"
                           placeholder="Contoh: Paket Lembah Harau"
                           required>

                </div>


                {{-- DESKRIPSI (otomatis terisi dari destinasi) --}}
                <div class="form-group">

                    <label>
                        Deskripsi
                    </label>

                    <textarea name="description"
                              id="description"
                              class="form-control"
                              rows="4"
                              placeholder="Otomatis terisi setelah pilih destinasi"
                              readonly></textarea>

                </div>


                {{-- HARGA + DURASI --}}
                <div class="form-row">

                    {{-- HARGA --}}
                    <div class="form-group col-md-6">

                        <label>
                            Harga Paket
                        </label>

                        <div class="input-group">

                            <div class="input-group-prepend">

                                <span class="input-group-text">
                                    Rp
                                </span>

                            </div>


                            <input type="text"
                                   id="price_display"
                                   class="form-control"
                                   placeholder="20.000"
                                   autocomplete="off"
                                   required>


                            <input type="hidden"
                                   name="price"
                                   id="price">

                        </div>

                    </div>


                    {{-- DURASI --}}
                    <div class="form-group col-md-6">

                        <label>
                            Durasi (Hari)
                        </label>

                        <input type="number"
                               name="duration_days"
                               class="form-control"
                               value="1"
                               min="1"
                               required>

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
                               class="form-control"
                               value="10"
                               min="1"
                               required>

                    </div>


                    {{-- TANGGAL --}}
                    <div class="form-group col-md-6">

                        <label>
                            Tanggal Keberangkatan
                        </label>

                        <input type="date"
                               name="departure_date"
                               class="form-control">

                    </div>

                </div>


                {{-- STATUS --}}
                <div class="form-group">

                    <label>
                        Status
                    </label>

                    <select name="status"
                            class="form-control">

                        <option value="active">
                            Active
                        </option>

                        <option value="inactive">
                            Inactive
                        </option>

                    </select>

                </div>


                {{-- BUTTON --}}
                <div class="form-actions">

                    <button type="submit"
                            class="save-btn">

                        <i class="fas fa-save"></i>

                        Simpan Paket

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



{{-- FORMAT HARGA + AUTO-FILL KATEGORI/DESKRIPSI --}}
@push('js')

<script>

// Data destinasi (kategori & deskripsi) untuk auto-fill
const destinationsData = {
    @foreach($destinations as $destination)
        {{ $destination->id }}: {
            category: @json($destination->category),
            description: @json($destination->description)
        },
    @endforeach
};

$(function () {

    // Auto-fill kategori & deskripsi saat destinasi dipilih
    $('#destination_id').on('change', function () {

        const id = $(this).val();

        if (!id || !destinationsData[id]) {
            $('#category').val('');
            $('#description').val('');
            return;
        }

        $('#category').val(destinationsData[id].category);
        $('#description').val(destinationsData[id].description);

    });


    // Format harga
    $('#price_display').on('input', function () {

        let angka = $(this)
            .val()
            .replace(/\D/g, '');

        // Simpan angka asli ke database
        $('#price').val(angka);

        // Tampilkan format Rupiah
        $(this).val(
            angka.replace(
                /\B(?=(\d{3})+(?!\d))/g,
                '.'
            )
        );

    });


    // Jika halaman dibuka kembali dengan nilai harga
    $('#price_display').on('blur', function () {

        let angka = $(this)
            .val()
            .replace(/\D/g, '');

        $('#price').val(angka);

        $(this).val(
            angka.replace(
                /\B(?=(\d{3})+(?!\d))/g,
                '.'
            )
        );

    });

});

</script>

@endpush

@endsection