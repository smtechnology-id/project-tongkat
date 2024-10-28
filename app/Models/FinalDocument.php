<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalDocument extends Model
{
    use HasFactory;
    protected $table = 'final_documents';
    protected $fillable = [
        'proposal_id',
        'final_exam_id',
        'user_id',
        'pass_foto',
        'buku_tugas_akhir',
        'surat_tugas_pembimbing',
        'surat_tugas_penguji_ujian_proposal',
        'berita_acara_ujian_proposal',
        'surat_tugas_penguji_tugas_akhir',
        'logbook_final_tugas_akhir',
        'kartu_kehadiran_peserta_seminar_proposal',
        'surat_keterangan_persetujuan_ujian_tugas_akhir',
        'berita_acara_ujian_tugas_akhir',
        'toefl',
        'letter_of_acceptance',
    ];

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function finalExam()
    {
        return $this->belongsTo(FinalExam::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
