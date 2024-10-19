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
        Schema::create('pergantian', function (Blueprint $table) {
            $table->string('kodepergantian',15)->primary();
            $table->string('namabrg');
            $table->foreign('namabrg')->references('namabrg')->on('barang');
            $table->string('ruangan');
            $table->foreign('ruangan')->references('namaruang')->on('ruangan');
            $table->integer('jumlah');
            $table->date('tglpergantian');
            $table->date('tglterima');
            $table->string('keterangan');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pergantian');
    }
};
