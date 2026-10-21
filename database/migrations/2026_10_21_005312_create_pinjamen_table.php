<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pinjaman', function (Blueprint $table) {
            $table->id();
            $table->foreignId('anggota_id')->constrained('anggota')->restrictOnDelete();
            $table->foreignId('user_id')->constrained('users'); // Kasir/Petugas
            $table->date('tanggal_pinjam');
            $table->decimal('jumlah', 15, 2);
            $table->integer('lama_angsuran'); // dalam bulan
            $table->decimal('bunga', 5, 2); // persentase bunga
            $table->enum('status', ['belum_lunas', 'lunas'])->default('belum_lunas');
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pinjaman');
    }
};