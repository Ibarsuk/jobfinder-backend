<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyLike extends Pivot
{
    public $timestamps = true;

    public $incrementing = false;

    protected $table = 'company_likes';
}
