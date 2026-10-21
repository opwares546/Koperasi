@extends('layouts.app')
@section('title', 'Edit Simpanan')

@section('content')
<div class="container py-4">
    <h3 class="mb-1">Edit Transaksi Simpanan</h3>
    <p class="text-muted">Perbaiki data transaksi simpanan anggota.</p>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('simpanan.update', $simpanan->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('simpanan._form')
            </form>
        </div>
    </div>
</div>
@endsection