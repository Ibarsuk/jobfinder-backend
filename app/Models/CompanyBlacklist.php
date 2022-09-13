<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyBlacklist extends Pivot
{
    public $timestamps = false;

    public $incrementing = false;

    protected $table = 'company_blacklist';
}
