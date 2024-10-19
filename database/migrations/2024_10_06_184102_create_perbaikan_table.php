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
        Schema::create('perbaikan', function (Blueprint $table) {
            $table->string('kodeperbaikan', 15)->primary();
            $table->string('kodelaporan', 15);
            $table->foreign('kodelaporan')->references('kodelaporan')->on('barangrusak')->onDelete('cascade');
            $table->string('namabrg');
            $table->foreign('namabrg')->references('namabrg')->on('barang');
            $table->date('tglperbaikan');
            $table->date('tglselesai');
            $table->string('vendor');
            $table->foreign('vendor')->references('namavendor')->on('vendor');
            $table->string('biaya');
            $table->string('bukti');
            $table->string('deskripsi');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('perbaikan');
    }
};
