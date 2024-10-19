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
        Schema::create('penempatan', function (Blueprint $table) {
            $table->string('kodepenempatan',13)->primary();
            $table->string('namabrg');
            $table->foreign('namabrg')->references('namabrg')->on('barang');
            $table->date('tglpenempatan');
            $table->string('ruangan');
            $table->foreign('ruangan')->references('namaruang')->on('ruangan');
            $table->string('jumlah');
            $table->string('kategori');
            $table->foreign('kategori')->references('kategori')->on('kategori');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penempatan');
    }
};
