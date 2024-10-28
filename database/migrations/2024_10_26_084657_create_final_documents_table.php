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
            $table->string('file_tugas_akhir')->nullable();
            $table->string('pass_foto')->nullable();
            $table->string('buku_tugas_akhir')->nullable();
            $table->string('surat_tugas_pembimbing')->nullable();
            $table->string('surat_tugas_penguji_ujian_proposal')->nullable();
            $table->string('berita_acara_ujian_proposal')->nullable();
            $table->string('surat_tugas_penguji_tugas_akhir')->nullable();
            $table->string('logbook_final_tugas_akhir')->nullable();
            $table->string('kartu_kehadiran_peserta_seminar_proposal')->nullable();
            $table->string('surat_keterangan_persetujuan_ujian_tugas_akhir')->nullable();
            $table->string('berita_acara_ujian_tugas_akhir')->nullable();
            $table->string('toefl')->nullable();
            $table->string('letter_of_acceptance')->nullable();
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
