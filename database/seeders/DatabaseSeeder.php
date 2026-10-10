<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::all();
        if(count($users) == 0){
            $user = new User();
            $user->name = "Ackerfe";
            $user->email = "acker.federico@gmail.com";
            $user->password = "12345678";
            $user->save();
        }

        $this->call([
            ProficienciesTableSeeder::class,
            FeatsTableSeeder::class,
            BackgroundsTableSeeder::class,
            FeaturesTableSeeder::class,
            SpeciesTableSeeder::class,
            ProfessionsTableSeeder::class,
            SpellsTableSeeder::class,
            FeatureSpeciesTableSeeder::class,
            BackgroundProficiencyTableSeeder::class,
            CharactersTableSeeder::class,
            CharacterFeatTableSeeder::class,
            CharacterProficiencyTableSeeder::class
        ]);
    }
}
