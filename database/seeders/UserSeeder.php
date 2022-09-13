<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    const MAX_IN_BLACKLIST = 4;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
    }

    public static function addRandomFormsToBlacklist ($users, $formsNumber, $tableName) {
        $users->each(function ($user) use ($formsNumber, $tableName) {
            $nonUniqueForms = array_map(
                function() use ($formsNumber) {return rand(1, $formsNumber);},
                array_fill(0, rand(1, UserSeeder::MAX_IN_BLACKLIST), null)
            );
            $randomForms = array_unique($nonUniqueForms);
            $tableNameCapitalized = ucfirst($tableName);
            $relation = "blacklisted{$tableNameCapitalized}";
            $user->$relation()->attach($randomForms);
        });
    }
}
