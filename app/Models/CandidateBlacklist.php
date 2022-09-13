<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CandidateBlacklist extends Pivot
{
    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'candidate_blacklist';
}
