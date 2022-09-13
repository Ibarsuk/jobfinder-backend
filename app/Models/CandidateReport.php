<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CandidateReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'candidate_id',
        'reported_field',
        'user_message',
    ];

    public function candidate() {
        return $this->belongsTo(Candidate::class);
    }
}
