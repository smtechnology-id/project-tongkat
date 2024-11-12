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
        Schema::create('final_exam', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('judul');
            $table->string('pembimbing_1'); //Pembimbing 1
            $table->string('pembimbing_2'); //Pembimbing 2
            $table->string('penguji_1'); //Penguji 1
            $table->string('penguji_2'); //Penguji 2
            $table->string('penguji_3'); //Penguji 3
            $table->string('file_1')->nullable(); // Dokumen Skripsi
            $table->string('file_2')->nullable(); //Surat Keterangan Persetujuan Tugas Akhir
            $table->string('file_3')->nullable(); //Kartu Kehadiran Ujian Proposal Tugas Akhir
            $table->string('file_4')->nullable(); //Logbook Kegiatan Tugas Akhir
            $table->string('status_kelengkapan_dokumen')->default('belum lengkap'); //status kelengkapan dokumen
            $table->string('status')->default('pending'); //status
            $table->enum('status_kelulusan', ['pending', 'lulus', 'tidak lulus'])->default('pending'); //status kelulusan
            $table->string('catatan_mahasiswa')->nullable(); //catatan
            $table->string('catatan_admin')->nullable(); //catatan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_exam');
    }
};
