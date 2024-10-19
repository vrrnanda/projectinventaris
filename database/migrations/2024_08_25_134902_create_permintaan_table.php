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
        Schema::create('permintaan', function (Blueprint $table) {
            $table->string('kodepermintaan', 15)->primary();
            $table->unsignedBigInteger('id_ruang');
            $table->foreign('id_ruang')->references('id_ruang')->on('ruangan');
            $table->date('tglpermintaan');
            $table->string('namabrg');
            $table->string('ruangan');
            $table->string('keterangan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permintaan');
    }
};
