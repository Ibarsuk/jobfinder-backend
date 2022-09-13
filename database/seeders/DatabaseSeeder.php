<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Candidate;
use App\Models\Company;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const USER_NUMBER = 10;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(TagSeeder::class);
        $tagsNumber = Tag::count();
        $users = User::factory($this::USER_NUMBER)->hasCandidate()->hasCompany()->create();
        
        $candidates = Candidate::all();
        $companies = Company::all();

        TagSeeder::attachRandomTags($tagsNumber, $candidates);
        TagSeeder::attachRandomTags($tagsNumber, $companies);

        UserSeeder::addRandomFormsToBlacklist($users, $candidates->count(), 'candidates');
        UserSeeder::addRandomFormsToBlacklist($users, $companies->count(), 'companies');
    }
}
