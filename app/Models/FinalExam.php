<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinalExam extends Model
{
    use HasFactory;
    protected $table = 'final_exam';
    protected $fillable = ['user_id', 'judul', 'pembimbing_1', 'pembimbing_2', 'penguji_1', 'penguji_2', 'penguji_3', 'file_1', 'file_2', 'file_3', 'file_4', 'status', 'catatan_admin', 'status_kelulusan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function examSchedule()
    {
        return $this->hasOne(ExamSchedule::class, 'final_exam_id');
    }
}
