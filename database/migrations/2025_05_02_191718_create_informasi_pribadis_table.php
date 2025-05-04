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
        Schema::create('informasi_pribadis', function (Blueprint $table) {
            $table->bigIncrements('id_informasi_pribadi');
            $table->unsignedBigInteger('id_user');
            $table->text('foto_ktp')->nullable();
            $table->text('foto_kk')->nullable();
            $table->text('foto_user')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('informasi_pribadis');
    }
};
