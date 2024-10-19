<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('peminjaman', function (Blueprint $table) {
            $table->string('kodepeminjaman',15)->primary();
            $table->string('kodebrg')->nullable();
            $table->foreign('kodebrg')->references('kodebrg')->on('barang');
            $table->unsignedBigInteger('id_ruang')->nullable();
            $table->foreign('id_ruang')->references('id_ruang')->on('ruangan');
            $table->string('barangpinjam');
            $table->string('ruangan');
            $table->date('tglpinjam');
            $table->integer('jumlah');
            $table->string('spesifikasi');
            $table->string('keperluan');
            $table->date('tglterima');
            $table->date('tglpengembalian');
            $table->date('tglkembali');
            $table->string('namabrg');
            $table->string('catatan');
            $table->string('status')->nullable();
            $table->string('statuskembali')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peminjaman');
    }
};
