@extends('layouts.app')
@section('title', 'Dashboard - KoperasiKu')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h3 class="mb-1">Dashboard KoperasiKu</h3>
            <p class="text-muted mb-0">Selamat datang kembali, {{ auth()->user()->name }}!</p>
        </div>
        <div>
            <span class="badge bg-primary fs-6">{{ now()->translatedFormat('l, d F Y') }}</span>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <!-- Card Anggota -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm bg-primary text-white h-100">
                <div class="card-body">
                    <h6 class="card-title text-white-50">Total Anggota Aktif</h6>
                    <h2 class="mb-0 fw-bold">{{ $totalAnggota }} <span class="fs-6 fw-normal">Orang</span></h2>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <a href="{{ route('anggota.index') }}" class="text-white text-decoration-none small">Lihat Detail &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card Simpanan -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm bg-success text-white h-100">
                <div class="card-body">
                    <h6 class="card-title text-white-50">Total Simpanan Masuk</h6>
                    <h2 class="mb-0 fw-bold">Rp {{ number_format($totalSimpanan, 0, ',', '.') }}</h2>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <a href="{{ route('simpanan.index') }}" class="text-white text-decoration-none small">Lihat Detail &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card Pinjaman -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm bg-warning h-100">
                <div class="card-body">
                    <h6 class="card-title text-dark-50">Pinjaman Berjalan</h6>
                    <h2 class="mb-0 fw-bold text-dark">Rp {{ number_format($totalPinjaman, 0, ',', '.') }}</h2>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <a href="{{ route('pinjaman.index') }}" class="text-dark text-decoration-none small">Lihat Detail &rarr;</a>
                </div>
            </div>
        </div>

        <!-- Card Angsuran -->
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm bg-info text-white h-100">
                <div class="card-body">
                    <h6 class="card-title text-white-50">Total Angsuran Diterima</h6>
                    <h2 class="mb-0 fw-bold">Rp {{ number_format($totalAngsuran, 0, ',', '.') }}</h2>
                </div>
                <div class="card-footer bg-transparent border-0 pt-0">
                    <a href="{{ route('angsuran.index') }}" class="text-white text-decoration-none small">Lihat Detail &rarr;</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection