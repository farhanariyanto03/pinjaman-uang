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
        Schema::create('pinjamans', function (Blueprint $table) {
            $table->bigIncrements('id_pinjaman');
            $table->bigInteger('jumlah_uang');
            $table->integer('tenor');
            $table->integer('bunga');
            $table->integer('jumlah_kotor');
            $table->integer('angsuran_per_bulan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pinjamen');
    }
};
