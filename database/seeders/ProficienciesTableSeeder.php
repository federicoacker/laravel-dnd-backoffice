<?php

namespace Database\Seeders;

use App\Models\Proficiency;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProficienciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        $file = file_get_contents(database_path('/data/proficiencies.json'));
        $json = json_decode($file,true);

        foreach($json as $proficiency){
            Proficiency::create([
                "name" => $proficiency['name'],
                "description" => $proficiency['description'],
                "ability_score" => $proficiency['ability_score'],
                "type" => $proficiency['type']
            ]);
        }
    }
}
