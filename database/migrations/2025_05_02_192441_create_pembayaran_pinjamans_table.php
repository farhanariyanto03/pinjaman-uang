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
        Schema::create('pembayaran_pinjamans', function (Blueprint $table) {
            $table->bigIncrements('id_pembayaran_pinjaman');
            $table->unsignedBigInteger('id_pengajuan_pinjaman');
            $table->bigInteger('jumlah_pembayaran');
            $table->date('tanggal_pembayaran');
            $table->enum('metode_pembayaran', ['transfer', 'potong gaji'])->nullable();
            $table->enum('status', ['menunggu', 'diterima', 'ditolak'])->default('menunggu');
            $table->timestamps();

            $table->foreign('id_pengajuan_pinjaman')->references('id_pengajuan_pinjaman')->on('pengajuan_pinjamans')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran_pinjamen');
    }
};
