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
        Schema::create('barangterbuang', function (Blueprint $table) {
            $table->string('kodehapus',15)->primary();
            $table->string('kodebrg')->nullable();
            $table->foreign('kodebrg')->references('kodebrg')->on('barang');
            $table->string('namabrg');
            $table->date('tglhapus');
            $table->integer('jumlah');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barangterbuang');
    }
};
