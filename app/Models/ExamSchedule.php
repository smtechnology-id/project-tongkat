<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamSchedule extends Model
{
    use HasFactory;
    protected $table = 'exam_schedules';
    protected $fillable = ['user_id', 'final_exam_id', 'waktu', 'tanggal', 'tempat', 'keterangan'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function finalExam()
    {
        return $this->belongsTo(FinalExam::class, 'final_exam_id');
    }
}
