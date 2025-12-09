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
        Schema::create('notifikasi', function (Blueprint $table) {
            $table->id('id_notifikasi');
            $table->unsignedBigInteger('id_sertifikat');
            $table->string('judul');
            $table->text('isi_pesan');
            $table->string('status_kirim')->default('pending');
            $table->date('tanggal_kirim')->nullable();

            $table->foreign('id_sertifikat')->references('id_sertifikat')->on('sertifikat')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasi');
    }
};
