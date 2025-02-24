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
        Schema::create('notifikasis', function (Blueprint $table) {
            $table->id('id_log');
            $table->foreignId('id_pengunjung')->constrained('pengunjungs','id_pengunjung')->onDelete('cascade');
            $table->foreignId('id_karyawan')->constrained('karyawans','id_karyawan')->onDelete('cascade');
            $table->string('judul_notif');
            $table->text('isi_notif');
            $table->enum('status', ['pending','read'])->default('pending');
            $table->timestamp('tgl_kirim_notif')->useCurrent();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('notifikasis');
    }
};
