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
        Schema::create('barangrusak', function (Blueprint $table) {
            $table->string('kodelaporan', 15)->primary();
            $table->string('namabrg');
            $table->foreign('namabrg')->references('namabrg')->on('barang');
            $table->string('ruangan');
            $table->foreign('ruangan')->references('namaruang')->on('ruangan');
            $table->string('deskripsi');
            $table->date('tgllaporan');
            $table->string('penanganan');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangrusak');
    }
};
