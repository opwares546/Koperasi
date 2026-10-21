@extends('layouts.app')
@section('title', 'Data Angsuran')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-2 mb-4">
        <div>
            <h3 class="mb-1">Data Angsuran</h3>
            <p class="text-muted mb-0">Riwayat dan tagihan cicilan pinjaman anggota.</p>
        </div>
        <a href="{{ route('angsuran.create') }}" class="btn btn-primary">
            + Catat Angsuran
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form method="GET" action="{{ route('angsuran.index') }}" class="row g-2 mb-3">
                <div class="col-md-5">
                    <input type="text" name="search" class="form-control" placeholder="Cari nama anggota..." value="{{ request('search') }}">
                </div>
                <div class="col-auto">
                    <button class="btn btn-primary">Cari</button>
                    <a href="{{ route('angsuran.index') }}" class="btn btn-outline-secondary">Reset</a>
                </div>
            </form>

            <div class="table-responsive">
                <table class="table table-hover table-bordered align-middle">
                    <thead class="table-primary">
                        <tr>
                            <th>Nama Anggota</th>
                            <th>Angsuran Ke</th>
                            <th>Jatuh Tempo</th>
                            <th>Tagihan (Rp)</th>
                            <th>Dibayar (Rp)</th>
                            <th>Tgl Bayar</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($angsuran as $item)
                            <tr>
                                <td>{{ $item->pinjaman->anggota->nama ?? '-' }}</td>
                                <td>{{ $item->angsuran_ke }}</td>
                                <td>{{ \Carbon\Carbon::parse($item->jatuh_tempo)->format('d-m-Y') }}</td>
                                <td class="text-end">{{ number_format($item->jumlah_tagihan, 0, ',', '.') }}</td>
                                <td class="text-end">{{ $item->jumlah_bayar ? number_format($item->jumlah_bayar, 0, ',', '.') : '-' }}</td>
                                <td>{{ $item->tanggal_bayar ? \Carbon\Carbon::parse($item->tanggal_bayar)->format('d-m-Y') : '-' }}</td>
                                <td>
                                    @if($item->status == 'lunas')
                                        <span class="badge bg-success">Lunas</span>
                                    @else
                                        <span class="badge bg-warning text-dark">Belum Lunas</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-1">
                                        <a href="{{ route('angsuran.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('angsuran.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">Hapus</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-4">Belum ada riwayat angsuran.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            {{ $angsuran->links() }}
        </div>
    </div>
</div>
@endsection