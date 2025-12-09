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
        Schema::create('sertifikat', function (Blueprint $table) {
            $table->id('id_sertifikat');
            $table->unsignedBigInteger('id_pengguna');
            $table->string('nomor_sertifikat')->unique();
            $table->string('sertifikasi');
            $table->date('tgl_terbit');
            $table->date('tgl_kadaluarsa');
            $table->string('status');
            $table->string('foto')->nullable();
            $table->timestamps();

            $table->foreign('id_pengguna')->references('id_pengguna')->on('pengguna')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikat');
    }
};
