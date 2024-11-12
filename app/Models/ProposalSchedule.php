<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProposalSchedule extends Model
{
    use HasFactory;
    protected $table = 'proposal_schedules';

    protected $fillable = [
        'user_id',
        'proposal_id',
        'waktu',
        'tanggal',
        'tempat',
        'dosen1',
        'dosen2',
        'dosen3',
        'keterangan',
    ];
    
    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
