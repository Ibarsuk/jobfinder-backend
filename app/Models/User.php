<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'first_name',
        'last_name',
        'email',
        'password',
        'age',
        'birth_date',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'created_at',
        'updated_at',
        //'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];

    public function candidate() {
        return $this->hasOne(Candidate::class);
    }
    
    public function blacklistedCandidates() {
        return $this->belongsToMany(Candidate::class, 'candidate_blacklist')->using(CandidateBlacklist::class);
    }
    
    public function graylistedCandidates() {
        return $this->belongsToMany(Candidate::class, 'candidate_graylist')->using(CandidateGraylist::class)->withTimestamps();
    }

    public function company() {
        return $this->hasOne(Company::class);
    }

    public function blacklistedCompanies() {
        return $this->belongsToMany(Company::class, 'company_blacklist')->using(CompanyBlacklist::class);
    }

    public function graylistedCompanies() {
        return $this->belongsToMany(Company::class, 'company_graylist')->using(CompanyGraylist::class);
    }

    public function tokens() {
        return $this->hasMany(Token::class);
    }
}
