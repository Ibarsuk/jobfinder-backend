<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $fillable = [
        'token',
        'expires',
    ];

    protected $casts = [
        'expires' => 'datetime',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
