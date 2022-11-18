<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CandidateGraylist extends Pivot
{
    public $incrementing = false;

    protected $table = 'candidate_graylist';
}
