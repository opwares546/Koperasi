@extends('layouts.app')
@section('title', 'Dashboard KoperasiKu')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 text-center">
            <h1 class="fw-bold mb-3">Selamat Datang di KoperasiKu</h1>
            <p class="lead text-muted mb-4">
                Sistem Informasi Manajemen Koperasi berbasis Web. Anda login sebagai <strong>{{ auth()->user()->name }}</strong>.
            </p>
            <div class="d-flex justify-content-center gap-3">
                <a href="{{ route('anggota.index') }}" class="btn btn-primary btn-lg px-4">
                    Data Anggota
                </a>
                <a href="{{ route('simpanan.index') }}" class="btn btn-outline-primary btn-lg px-4">
                    Data Simpanan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection