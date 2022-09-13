<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Candidate extends Model
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
        'relevant_at',
        'user_id',
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function blacklistedBy() {
        return $this->belongsToMany(User::class, 'candidate_blacklist')->using(CandidateBlacklist::class);
    }

    public function companiesLikes() {
        return $this->belongsToMany(Company::class, 'candidate_likes')->using(CandidateLike::class)->withTimestamps();
    }

    public function likedByCompanies() {
        return $this->belongsToMany(Company::class, 'company_likes')->using(CompanyLike::class)->withTimestamps();
    }

    public function reports() {
        return $this->hasMany(CandidateReport::class);
    }
}
