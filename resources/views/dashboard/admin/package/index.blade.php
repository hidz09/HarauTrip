@extends('layouts.main')
@section('title', 'Paket Wisata')
@section('content')
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.package.create') }}" class="btn btn-primary">
                <i class="nav-icon fas fa-plus"></i> Tambah Paket
            </a>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>Destinasi</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                @php
                    $no = 1;
                @endphp
                <tbody>
                    @foreach ($packages as $item)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $item->nama_paket }}</td>
                            <td>{{ $item->destinasi }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>{{ $item->durasi }}</td>
                            <td>{{ $item->kuota }}</td>
                            <td>
                                @if ($item->status == 'aktif')
                                    <span class="badge badge-success">Aktif</span>
                                @else
                                    <span class="badge badge-secondary">Nonaktif</span>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('admin.package.show', $item->id) }}" class="btn btn-warning">
                                    <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                                <a href="{{ route('admin.package.edit', $item->id) }}"
                                    class="btn btn-primary mt-2 mb-2"><i class="fas fa-edit mr-1"></i>Edit</a>
                                <br>
                                <form action="{{ route('admin.package.delete', $item->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin mau hapus paket wisata ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit" class="btn btn-danger"><i
                                            class="fas fa-trash mr-1"></i>Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>#</th>
                        <th>Nama Paket</th>
                        <th>Destinasi</th>
                        <th>Harga</th>
                        <th>Durasi</th>
                        <th>Kuota</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
@endsection