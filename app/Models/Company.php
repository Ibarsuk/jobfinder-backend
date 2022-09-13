<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $guarded = [
        'relevant_at',
        'id',
        'user_id',
        'created_at',
        'updated_at',
    ];

    protected $hidden = [
        'user_id',
        'relevant_at',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function blacklistedBy() {
        return $this->belongsToMany(User::class, 'company_blacklist')->using(CompanyBlacklist::class);
    }

    public function likedByCandidates() {
        return $this->belongsToMany(Candidate::class, 'candidate_likes')->using(CandidateLike::class)->withTimestamps();
    }

    public function candidatesLikes() {
        return $this->belongsToMany(Candidate::class, 'company_likes')->using(CompanyLike::class)->withTimestamps();
    }

    public function reports() {
        return $this->hasMany(CompanyReport::class);
    }
}
