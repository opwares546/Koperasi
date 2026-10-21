@extends('layouts.app')
@section('title', 'Catat Pinjaman')

@section('content')
<div class="container py-4">
    <h3 class="mb-1">Catat Pinjaman Baru</h3>
    <p class="text-muted">Masukkan data transaksi pinjaman anggota KoperasiKu.</p>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('pinjaman.store') }}" method="POST">
                @csrf
                @include('pinjaman._form')
            </form>
        </div>
    </div>
</div>
@endsection