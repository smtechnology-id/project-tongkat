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
        Schema::create('proposals', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('judul');
            $table->string('pembimbing1');
            $table->string('pembimbing2');
            $table->string('file');
            $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->enum('status_kelulusan', ['pending', 'lulus', 'tidak lulus'])->default('pending');
            $table->text('catatan_mahasiswa')->nullable();
            $table->text('catatan_admin')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proposals');
    }
};
