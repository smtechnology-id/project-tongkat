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
        'pembimbing3',
        'file',
        'status',
        'catatan_mahasiswa',
        'catatan_admin'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
