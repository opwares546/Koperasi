@extends('layouts.app')
@section('title', 'Data Anggota')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h3 class="mb-1">Data Anggota</h3>
            <p class="text-muted mb-0">Kelola informasi biodata anggota KoperasiKu.</p>
        </div>
        <a href="{{ route('anggota.create') }}" class="btn btn-primary">
            + Tambah Anggota
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('anggota.index') }}" class="row g-2 mb-3">
                <div class="col-md-6">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama, No. Anggota, atau NIK" value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Cari</button>
                    <a href="{{ route('anggota.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>No. Anggota</th>
                            <th>Nama Lengkap</th>
                            <th>L/P</th>
                            <th>No. HP</th>
                            <th>Status</th>
                            <th style="min-width: 190px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($anggota as $item)
                            <tr>
                                <td><span class="badge text-bg-light border">{{ $item->no_anggota }}</span></td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->jenis_kelamin }}</td>
                                <td>{{ $item->no_hp }}</td>
                                <td>
                                    @if($item->status === 'aktif')
                                        <span class="badge text-bg-success">Aktif</span>
                                    @else
                                        <span class="badge text-bg-secondary">Nonaktif</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a href="{{ route('anggota.show', $item->id) }}" class="btn btn-sm btn-info text-white">Detail</a>
                                        <a href="{{ route('anggota.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('anggota.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus anggota ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4">Belum ada data anggota.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $anggota->links() }}
        </div>
    </div>
</div>
@endsection