@extends('layouts.app')
@section('title', 'Catat Angsuran')

@section('content')
<div class="container py-4">
    <h3 class="mb-1">Catat Angsuran Baru</h3>
    <p class="text-muted">Buat tagihan atau catat pembayaran angsuran anggota.</p>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('angsuran.store') }}" method="POST">
                @csrf
                @include('angsuran._form')
            </form>
        </div>
    </div>
</div>
@endsection