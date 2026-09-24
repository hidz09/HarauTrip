@extends('layouts.main')
@section('title', 'Tambah Paket Wisata')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Tambah Paket Wisata</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.package.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label>Destinasi</label>
                    <select name="destination_id" class="form-control" required>
                        <option value="">-- Pilih Destinasi --</option>
                        @foreach ($destinations as $destination)
                            <option value="{{ $destination->id }}">{{ $destination->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Paket</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price') }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Durasi (hari)</label>
                        <input type="number" name="duration_days" class="form-control" value="{{ old('duration_days', 1) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Kuota Peserta</label>
                        <input type="number" name="quota" class="form-control" value="{{ old('quota', 10) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tanggal Keberangkatan</label>
                        <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date') }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="inactive">Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Simpan</button>
                <a href="{{ route('admin.package.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection