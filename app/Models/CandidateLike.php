<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CandidateLike extends Pivot
{
    public $timestamps = true;

    public $incrementing = false;

    protected $table = 'candidate_likes';
}
