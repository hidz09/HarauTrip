@extends('layouts.main')

@section('title', 'Tambah Destinasi')

@section('content')

<style>
    .form-card{
        border:0;border-radius:16px;overflow:hidden;
        box-shadow:0 4px 20px rgba(16,44,34,.08);
        max-width:720px;margin:0 auto
    }

    .form-card .card-header{
        background:#102c22;color:#fff;border:0;padding:18px 20px;
        display:flex;align-items:center;justify-content:space-between
    }

    .form-title{
        margin:0;font-size:18px;font-weight:700
    }

    .form-title i{color:#d6ad73;margin-right:8px}

    .btn-back{
        background:transparent;color:#fff;border:1px solid rgba(255,255,255,.4);
        border-radius:8px;font-size:13px;font-weight:600;padding:6px 12px
    }

    .btn-back:hover{background:rgba(255,255,255,.1);color:#fff}

    .form-card .card-body{padding:25px}

    .form-card label{
        font-size:13px;font-weight:600;color:#26332b
    }

    .form-card .form-control,
    .form-card .form-control-file{
        border:1px solid #dfe4df;border-radius:8px;
        font-size:13px;box-shadow:none
    }

    .form-card .form-control:focus{
        border-color:#4c7a4c;
        box-shadow:0 0 0 3px rgba(76,122,76,.1)
    }

    .btn-save{
        background:#d6ad73;color:#102c22;border:0;
        border-radius:8px;font-weight:600;padding:10px 22px
    }

    .btn-save:hover{background:#e2bd87;color:#102c22}

    .btn-cancel{
        background:#f0f1ee;color:#59625c;
        border:0;border-radius:8px;font-weight:600;padding:10px 22px
    }

    .btn-cancel:hover{background:#e4e5e1;color:#3d443f}
</style>

<div class="card form-card">

    <div class="card-header">
        <h3 class="form-title">
            <i class="fas fa-plus-circle"></i>
            Tambah Destinasi
        </h3>

        <a href="{{ route('admin.destination.index') }}" class="btn btn-back btn-sm">
            <i class="fas fa-arrow-left mr-1"></i>
            Kembali
        </a>
    </div>

    <div class="card-body">

        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.destination.store') }}"
              method="POST"
              enctype="multipart/form-data">

            @csrf

            <div class="form-group">
                <label>Nama Destinasi</label>
                <input type="text"
                       name="name"
                       class="form-control"
                       value="{{ old('name') }}"
                       placeholder="Contoh: Sarasah Bunta"
                       required>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Kategori</label>
                    <input type="text"
                           name="category"
                           class="form-control"
                           value="{{ old('category') }}"
                           placeholder="Contoh: Wisata Alam"
                           required>
                </div>

                <div class="form-group col-md-6">
                    <label>Lokasi</label>
                    <input type="text"
                           name="location"
                           class="form-control"
                           value="{{ old('location') }}"
                           placeholder="Contoh: Harau, Lima Puluh Kota"
                           required>
                </div>
            </div>

            <div class="form-group">
                <label>Deskripsi</label>
                <textarea name="description"
                          rows="3"
                          class="form-control"
                          placeholder="Masukkan deskripsi...">{{ old('description') }}</textarea>
            </div>

            <div class="form-row">
    <div class="form-group col-md-6">
        <label>Jam Buka</label>
        <input type="time"
               name="open_time"
               class="form-control"
               value="{{ old('open_time') }}"
               required>
    </div>

    <div class="form-group col-md-6">
        <label>Jam Tutup</label>
        <input type="time"
               name="close_time"
               class="form-control"
               value="{{ old('close_time') }}"
               required>
    </div>
</div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label>Gambar</label>
                    <input type="file"
                           name="image"
                           class="form-control-file"
                           accept="image/*">
                </div>

                <div class="form-group col-md-6">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>
                            Aktif
                        </option>
                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>
                            Nonaktif
                        </option>
                    </select>
                </div>
            </div>

            <div class="form-group mb-4">
                <label>URL Video (opsional)</label>
                <input type="url"
                       name="video_url"
                       class="form-control"
                       value="{{ old('video_url') }}"
                       placeholder="https://...">
            </div>

            <a href="{{ route('admin.destination.index') }}" class="btn btn-cancel">
                Batal
            </a>

            <button type="submit" class="btn btn-save">
                <i class="fas fa-save mr-1"></i>
                Simpan Destinasi
            </button>

        </form>

    </div>
</div>

@endsection