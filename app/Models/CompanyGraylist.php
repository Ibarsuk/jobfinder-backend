<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class CompanyGraylist extends Pivot
{
    public $incrementing = false;

    protected $table = 'company_graylist';
}
