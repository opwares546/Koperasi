@extends('layouts.app')
@section('title', 'Catat Simpanan')

@section('content')
<div class="container py-4">
    <h3 class="mb-1">Catat Simpanan Baru</h3>
    <p class="text-muted">Masukkan data transaksi simpanan anggota KoperasiKu.</p>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('simpanan.store') }}" method="POST">
                @csrf
                @include('simpanan._form')
            </form>
        </div>
    </div>
</div>
@endsection