@extends('layouts.app')
@section('title', 'Edit Anggota')

@section('content')
<div class="container py-4">
    <h3 class="mb-1">Edit Data Anggota</h3>
    <p class="text-muted">Perbarui informasi untuk anggota {{ $anggota->nama }}.</p>
    <div class="card border-0 shadow-sm">
        <div class="card-body">
            <form action="{{ route('anggota.update', $anggota->id) }}" method="POST">
                @csrf
                @method('PUT')
                @include('anggota._form')
            </form>
        </div>
    </div>
</div>
@endsection