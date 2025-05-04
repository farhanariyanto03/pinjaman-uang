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
        Schema::create('detail_pengajuans', function (Blueprint $table) {
            $table->bigIncrements('id_detail_pengajuan');
            $table->unsignedBigInteger('id_pengajuan_pinjaman');
            $table->string('tujuan_pinjaman');
            $table->string('alasan_peminjaman');
            $table->timestamps();

            $table->foreign('id_pengajuan_pinjaman')->references('id_pengajuan_pinjaman')->on('pengajuan_pinjamans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_pengajuans');
    }
};
