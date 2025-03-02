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
        Schema::create('pengunjungs', function (Blueprint $table) {
            $table->id('id_pengunjung');
            $table->foreignId('id_karyawan')->constrained('karyawans','id_karyawan')->onDelete('cascade')->nullable();
            $table->string('nama_instansi');
            $table->dateTime('tanggal_pertemuan');
            $table->dateTime('tanggal_selesai')->nullable();
            $table->enum('status', ['pending','finish'])->default('pending');
            $table->string('nama_pengunjung');
            $table->string('nomor_pengunjung');
            $table->string('karyawan_dituju');
            $table->string('tujuan_pertemuan');
            $table->string('foto_identitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengunjungs');
    }
};
