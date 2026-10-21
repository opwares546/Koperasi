<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;

    // Beritahu Laravel nama tabel aslinya
    protected $table = 'simpanan';
    
    // Izinkan semua kolom diisi kecuali ID
    protected $guarded = ['id'];

    // Relasi ke tabel anggota
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }

    // Relasi ke tabel users (petugas yang mencatat)
    public function petugas()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}