<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    use HasFactory;

    // Beritahu Laravel nama tabel yang benar (karena defaultnya jamak/anggotas)
    protected $table = 'anggota';

    // Izinkan semua kolom diisi kecuali ID
    protected $guarded = ['id'];
}