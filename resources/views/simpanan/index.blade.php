@extends('layouts.app')
@section('title', 'Data Simpanan')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h3 class="mb-1">Data Simpanan</h3>
            <p class="text-muted mb-0">Riwayat transaksi simpanan seluruh anggota KoperasiKu.</p>
        </div>
        <a href="{{ route('simpanan.create') }}" class="btn btn-primary">
            + Catat Simpanan
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('simpanan.index') }}" class="row g-2 mb-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau No. Anggota..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Cari</button>
                    <a href="{{ route('simpanan.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Anggota</th>
                            <th>Nama Anggota</th>
                            <th>Jenis Simpanan</th>
                            <th>Jumlah (Rp)</th>
                            <th>Petugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($simpanan as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_transaksi)->format('d-m-Y') }}</td>
                                <td><span class="badge text-bg-light border">{{ $item->anggota->no_anggota }}</span></td>
                                <td>{{ $item->anggota->nama }}</td>
                                <td>{{ ucfirst($item->jenis_simpanan) }}</td>
                                <td class="text-end">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $item->petugas->name }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a href="{{ route('simpanan.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('simpanan.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-4">Belum ada riwayat transaksi simpanan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $simpanan->links() }}
        </div>
    </div>
</div>
@endsection