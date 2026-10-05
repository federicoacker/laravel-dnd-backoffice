<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $abilities = [
            "Strength",
            "Dexterity",
            "Constitution",
            "Intellect",
            "Wisdom",
            "Charisma"
        ];

        $newProfession = new Profession();
        $newProfession->name = fake()->word();
        $newProfession->primary_ability = $abilities[array_rand($abilities)];
        $newProfession->hit_points_die = "1d8";
        $newProfession->hit_points_at_level_1 = "8 + constitution modifier";
        $newProfession->armor_training = fake()->paragraph();
        $newProfession->starting_equipment = fake()->paragraph();
        $newProfession->save();
    }
}
