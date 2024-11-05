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
        'file_1',
        'file_2',
        'file_3',
        'file_4',
        'file_5',
        'file_6',
        'file_7',
        'file_8',
        'file_9',
        'file_10',
        'file_11',
        'file_12',
        'file_13',
        'file_14',
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
