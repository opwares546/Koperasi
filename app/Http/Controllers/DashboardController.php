<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Simpanan;
use App\Models\Pinjaman;
use App\Models\Angsuran;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAnggota = Anggota::where('status', 'aktif')->count();
        $totalSimpanan = Simpanan::sum('jumlah');
        
        // Hanya menghitung pinjaman yang masih berjalan (belum lunas)
        $totalPinjaman = Pinjaman::where('status', 'belum_lunas')->sum('jumlah');
        
        // Total uang angsuran yang sudah benar-benar dibayar
        $totalAngsuran = Angsuran::whereNotNull('tanggal_bayar')->sum('jumlah_bayar');

        return view('dashboard', compact('totalAnggota', 'totalSimpanan', 'totalPinjaman', 'totalAngsuran'));
    }
}