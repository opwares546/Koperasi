<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::create('simpanan', function (Blueprint $table) {
        $table->id();
        $table->foreignId('anggota_id')->constrained('anggota')->onDelete('cascade');
        $table->string('jenis_simpanan'); 
        $table->decimal('jumlah_simpanan', 15, 2);
        $table->date('tanggal_simpan');
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('simpanan');
    }
};
