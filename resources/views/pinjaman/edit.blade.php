@extends('layouts.app')
@section('title', 'Edit Pinjaman')

@section('content')
<div class="container py-4">
    <h3 class="mb-1">Edit Transaksi Pinjaman</h3>
    <p class="text-muted">Perbaiki data atau ubah status pinjaman anggota.</p>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('pinjaman.update', $pinjaman->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('pinjaman._form')
            </form>
        </div>
    </div>
</div>
@endsection