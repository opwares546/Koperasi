@extends('layouts.app')
@section('title', 'Data Pinjaman')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h3 class="mb-1">Data Pinjaman</h3>
            <p class="text-muted mb-0">Riwayat transaksi pinjaman seluruh anggota KoperasiKu.</p>
        </div>
        <a href="{{ route('pinjaman.create') }}" class="btn btn-primary">
            + Catat Pinjaman
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('pinjaman.index') }}" class="row g-2 mb-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama atau No. Anggota..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Cari</button>
                    <a href="{{ route('pinjaman.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Tanggal</th>
                            <th>No. Anggota</th>
                            <th>Nama Anggota</th>
                            <th>Jumlah (Rp)</th>
                            <th>Lama</th>
                            <th>Bunga</th>
                            <th>Status</th>
                            <th>Petugas</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pinjaman as $item)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($item->tanggal_pinjam)->format('d-m-Y') }}</td>
                                <td><span class="badge text-bg-light border">{{ $item->anggota->no_anggota }}</span></td>
                                <td>{{ $item->anggota->nama }}</td>
                                <td class="text-end">{{ number_format($item->jumlah, 0, ',', '.') }}</td>
                                <td>{{ $item->lama_angsuran }} Bln</td>
                                <td>{{ $item->bunga }}%</td>
                                <td>
                                    @if($item->status == 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum Lunas</span>
                                    @endif
                                </td>
                                <td>{{ $item->petugas->name }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a href="{{ route('pinjaman.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('pinjaman.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-4">Belum ada riwayat transaksi pinjaman.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $pinjaman->links() }}
        </div>
    </div>
</div>
@endsection
