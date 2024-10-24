<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    use HasFactory;
    protected $table = 'proposals';

    protected $fillable = [
        'user_id',
        'judul',
        'pembimbing1',
        'pembimbing2',
        'file',
        'status',
        'catatan_mahasiswa',
        'catatan_admin',
        'status_kelulusan'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function proposalSchedules()
    {
        return $this->hasMany(ProposalSchedule::class);
    }
}
