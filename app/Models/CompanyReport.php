<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'company_id',
        'reported_field',
        'user_message',
    ];

    public function company() {
        return $this->belongsTo(Company::class);
    }
}
