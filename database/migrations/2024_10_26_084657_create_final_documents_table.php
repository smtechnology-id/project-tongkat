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
        Schema::create('final_documents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('proposal_id');
            $table->foreign('proposal_id')->references('id')->on('proposals')->onDelete('cascade');
            $table->unsignedBigInteger('final_exam_id');
            $table->foreign('final_exam_id')->references('id')->on('final_exam')->onDelete('cascade');
            $table->string('file_1')->nullable(); // pass foto
            $table->string('file_2')->nullable(); // buku tugas akhir
            $table->string('file_3')->nullable(); // Form Perbaikan/Revisi Ujian Proposal
            $table->string('file_4')->nullable(); // Form Perbaikan/Revisi Ujian Tugas Akhir
            $table->string('file_5')->nullable(); // Surat Tugas Pembimbing
            $table->string('file_6')->nullable(); // Surat Tugas Penguji Ujian Proposal
            $table->string('file_7')->nullable(); // Berita Acara Ujian Proposal
            $table->string('file_8')->nullable(); // Surat Tugas Penguji Tugas Akhir
            $table->string('file_9')->nullable(); // Logbook Final Tugas
            $table->string('file_10')->nullable(); // Kartu Kehadiran Peserta Seminar Proposal
            $table->string('file_11')->nullable(); // Surat Keterangan Persetujuan Ujian Tugas Akhir
            $table->string('file_12')->nullable(); // Berita Acara Ujian Tugas Akhir
            $table->string('file_13')->nullable(); // TOEFL
            $table->string('file_14')->nullable(); // Letter of Acceptance (LOA)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('final_documents');
    }
};
