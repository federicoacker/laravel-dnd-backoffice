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
        $ability_scores = [
            "Strength",
            "Dexterity",
            "Constitution",
            "Intellect",
            "Wisdom",
            "Charisma"
        ];
        
        $types = [
            'Skill',
            'Tool',
            'Weapon'
        ];

        for($i = 0; $i<6; $i++){
            $newProficiency = new Proficiency();
            $newProficiency->name = fake()->word();
            $newProficiency->description = fake()->paragraph();
            $newProficiency->ability_score = $ability_scores[array_rand($ability_scores)];
            $newProficiency->type = $types[array_rand($types)];
            $newProficiency->save();
        }
    }
}
