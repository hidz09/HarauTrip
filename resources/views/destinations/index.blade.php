@extends('layouts.main')

@section('title', 'Data Destinasi')

@section('content')

<style>
    .destination-card{
        border:0;border-radius:16px;overflow:hidden;
        box-shadow:0 4px 20px rgba(16,44,34,.08)
    }

    .destination-card .card-header{
        background:#102c22;color:#fff;border:0;padding:18px 20px;
        display:flex;align-items:center;justify-content:space-between;
        gap:12px;flex-wrap:nowrap
    }

    .destination-title{
        margin:0;font-size:18px;font-weight:700;
        white-space:nowrap;overflow:hidden;text-overflow:ellipsis
    }

    .destination-title i{color:#d6ad73;margin-right:8px}

    .btn-add{
        background:#d6ad73;color:#102c22;border:0;
        border-radius:8px;font-weight:600;
        white-space:nowrap;flex-shrink:0
    }

    .btn-add:hover{
        background:#e2bd87;color:#102c22
    }

    .destination-table{margin:0}

    .destination-table th{
        background:#f5f1e8;color:#68736d;border:0;
        font-size:11px;text-transform:uppercase;
        letter-spacing:.04em;padding:12px;white-space:nowrap
    }

    .destination-table td{
        padding:12px;vertical-align:middle;
        border-top:1px solid #f0f1ee;font-size:13px
    }

    .destination-table tbody tr:hover{background:#fafbf9}

    .destination-img,.no-image{
        width:70px;height:55px;border-radius:8px
    }

    .destination-img{object-fit:cover}

    .no-image{
        background:#f0f1ee;color:#888;
        display:flex;align-items:center;justify-content:center;
        font-size:10px
    }

    .category,.badge-custom{
        display:inline-block;border-radius:20px;
        padding:5px 9px;font-size:11px;font-weight:600
    }

    .category{
        background:#f1eee6;color:#806746
    }

    .location{color:#68736d!important;white-space:nowrap}
    .location i{color:#4c7a4c;margin-right:5px}

    .badge-video,.badge-active{
        background:#e8f5ec;color:#28733f
    }

    .badge-no-video,.badge-inactive{
        background:#f0f1f0;color:#777
    }

    .action-btn{
        width:32px;height:32px;padding:0;border:0;
        border-radius:8px;display:inline-flex;
        align-items:center;justify-content:center
    }

    .btn-edit{
        background:#fff3dc;color:#a66b17
    }

    .btn-edit:hover{background:#f6e5bd;color:#8a5811}

    .btn-delete{
        background:#fdeaea;color:#b23b3b
    }

    .btn-delete:hover{background:#f7d5d5;color:#912e2e}

    .destination-alert{
        margin:15px;border:0;border-radius:9px;
        background:#e8f5ec;color:#28733f;font-size:13px
    }

    /* Tabel tetap bisa di-scroll ke samping di HP, tapi HEADER (judul + tombol Tambah)
       tetap sejajar/di samping, tidak lagi ditumpuk ke bawah */
    @media(max-width:768px){
        .destination-title{
            font-size:15px
        }

        .btn-add{
            padding:6px 10px;font-size:12px
        }

        .destination-table{min-width:900px}
    }
</style>

<div class="card destination-card">

    {{-- HEADER --}}
    <div class="card-header">
        <h3 class="destination-title">
            <i class="fas fa-map-marked-alt"></i>
            Data Destinasi
        </h3>

        <a href="{{ route('admin.destination.create') }}"
           class="btn btn-add btn-sm">
            <i class="fas fa-plus mr-1"></i>
            Tambah Destinasi
        </a>
    </div>

    {{-- TABLE --}}
    <div class="card-body p-0">

        @if(session('success'))
            <div class="alert destination-alert">
                <i class="fas fa-check-circle mr-1"></i>
                {{ session('success') }}
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover destination-table">
                <thead>
                    <tr>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Jam Buka</th>
                        <th>Video</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($destinations as $destination)
                        <tr>

                            <td>
                                @if($destination->image)
                                    <img src="{{ asset('storage/'.$destination->image) }}"
                                         alt="{{ $destination->name }}"
                                         class="destination-img">
                                @else
                                    <div class="no-image">Tidak ada</div>
                                @endif
                            </td>

                            <td>
                                <strong>{{ $destination->name }}</strong>
                            </td>

                            <td>
                                <span class="category">
                                    {{ $destination->category }}
                                </span>
                            </td>

                            <td class="location">
                                <i class="fas fa-map-marker-alt"></i>
                                {{ $destination->location }}
                            </td>

                            <td class="text-nowrap">
                                {{ \Illuminate\Support\Carbon::parse($destination->open_time)->format('H:i') }}
                                -
                                {{ \Illuminate\Support\Carbon::parse($destination->close_time)->format('H:i') }}
                            </td>

                            <td>
                                @if($destination->video_url)
                                    <span class="badge-custom badge-video">
                                        <i class="fas fa-video mr-1"></i>Ada
                                    </span>
                                @else
                                    <span class="badge-custom badge-no-video">
                                        Tidak ada
                                    </span>
                                @endif
                            </td>

                            <td>
                                <span class="badge-custom
                                    {{ $destination->status === 'active'
                                        ? 'badge-active'
                                        : 'badge-inactive' }}">
                                    {{ $destination->status === 'active'
                                        ? 'Aktif'
                                        : 'Nonaktif' }}
                                </span>
                            </td>

                            <td class="text-nowrap">

                                {{-- EDIT --}}
                                <a href="{{ route('admin.destination.edit', $destination->id) }}"
                                   class="btn action-btn btn-edit"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>

                                {{-- DELETE --}}
                                <form action="{{ route('admin.destination.delete',$destination->id) }}"
                                      method="POST"
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin ingin menghapus destinasi ini?')">
                                    @csrf
                                    @method('DELETE')

                                    <button type="submit"
                                            class="btn action-btn btn-delete"
                                            title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>

                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="8"
                                class="text-center py-4 text-muted">
                                Belum ada data destinasi.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection