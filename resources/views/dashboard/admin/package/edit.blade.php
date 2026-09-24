@extends('layouts.main')
@section('title', 'Edit Paket Wisata')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Edit Paket Wisata</h3>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.package.update', $package->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label>Destinasi</label>
                    <select name="destination_id" class="form-control" required>
                        @foreach ($destinations as $destination)
                            <option value="{{ $destination->id }}" {{ $package->destination_id == $destination->id ? 'selected' : '' }}>
                                {{ $destination->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label>Nama Paket</label>
                    <input type="text" name="name" class="form-control" value="{{ old('name', $package->name) }}" required>
                </div>

                <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description', $package->description) }}</textarea>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Harga (Rp)</label>
                        <input type="number" name="price" class="form-control" value="{{ old('price', $package->price) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Durasi (hari)</label>
                        <input type="number" name="duration_days" class="form-control" value="{{ old('duration_days', $package->duration_days) }}" required>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Kuota Peserta</label>
                        <input type="number" name="quota" class="form-control" value="{{ old('quota', $package->quota) }}" required>
                    </div>
                    <div class="form-group col-md-6">
                        <label>Tanggal Keberangkatan</label>
                        <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date', $package->departure_date?->format('Y-m-d')) }}">
                    </div>
                </div>

                <div class="form-group">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" {{ $package->status === 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ $package->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Update</button>
                <a href="{{ route('admin.package.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
@endsection