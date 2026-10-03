<?php

namespace Database\Seeders;

use App\Models\Background;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BackgroundsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newBackground = new Background();
        $newBackground->name = fake()->word();
        $newBackground->feat_id = 1;
        $newBackground->ability_scores = "Strenght,Dexterity,Constitution";
        $newBackground->equipment = fake()->paragraph();
        $newBackground->save();
    }
}
