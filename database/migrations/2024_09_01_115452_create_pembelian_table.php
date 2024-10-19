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
        Schema::create('pembelian', function (Blueprint $table) {
            $table->string('kodepembelian', 15)->primary();
            $table->string('namabrg');
            $table->date('tglbeli');
            $table->unsignedBigInteger('id_vendor')->nullable();
            $table->foreign('id_vendor')->references('id_vendor')->on('vendor')->onDelete('cascade');
            $table->date('tglterima');
            $table->string('vendor');
            $table->string('harga');
            $table->string('bukti');
            $table->string('spesifikasi');
            $table->integer('jumlah');
            $table->string('status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembelian');
    }
};
