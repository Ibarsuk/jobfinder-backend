<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Candidate;
use App\Models\CandidateReport;
use App\Models\Company;
use App\Models\CompanyReport;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    const USER_NUMBER = 500;
    const CANDIDATE_REPORTS_NUMBER = 3;
    const COMPANIES_REPORTS_NUMBER = 3;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {   
        $this->call(TagSeeder::class);

        User::factory($this::USER_NUMBER)->hasCandidate()->hasCompany()->create();
        $this->call(CustomSeeder::class);

        $users = User::all();
        $candidates = Candidate::all();
        $companies = Company::all();

        $tagsNumber = Tag::count();
        $candidatesNumber = $candidates->count();
        $companiesNumber = $companies->count();

        TagSeeder::attachRandomTags($tagsNumber, $candidates);
        TagSeeder::attachRandomTags($tagsNumber, $companies);

        UserSeeder::addRandomFormsToBlacklist($users, $candidatesNumber, 'candidates');
        UserSeeder::addRandomFormsToBlacklist($users, $companiesNumber, 'companies');

        CandidateReport::factory(DatabaseSeeder::CANDIDATE_REPORTS_NUMBER)
            ->sequence(fn () => ['candidate_id' => rand(1, $candidatesNumber)])
            ->create();

        CompanyReport::factory(DatabaseSeeder::COMPANIES_REPORTS_NUMBER)
            ->sequence(fn () => ['company_id' => rand(1, $companiesNumber)])
            ->create();
    }
}
