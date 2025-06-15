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
        Schema::create('pengajuan_pinjamans', function (Blueprint $table) {
            $table->bigIncrements('id_pengajuan_pinjaman');
            $table->char('id_user', 8);
            $table->bigInteger('jumlah_pinjaman');
            $table->bigInteger('tenor');
            $table->unsignedBigInteger('id_bunga')->nullable();
            $table->bigInteger('jumlah_kotor')->nullable();
            $table->bigInteger('angsuran_per_bulanan')->nullable();
            $table->date('jatuh_tempo');
            $table->enum('status', ['menunggu', 'diterima', 'lunas', 'ditolak'])->default('menunggu');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_bunga')->references('id_bunga')->on('bungas')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengajuan_pinjamen');
    }
};
