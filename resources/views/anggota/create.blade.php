@extends('layouts.app')
@section('title', 'Tambah Anggota')

@section('content')
<div class="container py-4">
    <h3 class="mb-1">Tambah Anggota Baru</h3>
    <p class="text-muted">Masukkan biodata diri anggota koperasi KoperasiKu.</p>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('anggota.store') }}" method="POST">
                @csrf
                @include('anggota._form')
            </form>
        </div>
    </div>
</div>
@endsection