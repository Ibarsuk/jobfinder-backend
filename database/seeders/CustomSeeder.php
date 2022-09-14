<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CustomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tester = User::factory()
            ->state([
                'first_name' => 'My',
                'last_name' => 'Tester',
                'email' => 'mytester237@mail.com',
                'password' => Hash::make('!!11QQwas'),
                'age' => 24,
            ])
            ->hasCandidate()
            ->hasCompany()
            ->create();

        $tester->candidate->likedByCompanies()->attach([2, 3, 4]);
        $tester->company->likedByCandidates()->attach([2, 3, 4]);
    }
}
