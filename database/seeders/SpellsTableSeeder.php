<?php

namespace Database\Seeders;

use App\Models\Spell;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpellsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $casting_times = [
            "action",
            "bonus action",
            "reaction",
            "1 minute",
            "10 minutes",
            "1 hour"
        ];

        $ranges = [
            "touch",
            "15 feet",
            "30 feet",
            "60 feet",
            "90 feet",
            "120 feet",
            "240 feet"
        ];

        $components = [
            "V",
            "S",
            "M"
        ];

        $components_number = rand(0,3);

        $components_string = "";

        $durations = [
            "instantaneous",
            "1 minute",
            "10 minutes",
            "1 hour",
            "8 hours"
        ];

        $newSpell = new Spell();
        $newSpell->name = fake()->word();
        $newSpell->level = rand(0,9);
        $newSpell->casting_time = $casting_times[array_rand($casting_times)];
        $newSpell->range = $ranges[array_rand($ranges)];
        $i = 0;
        while($i < $components_number){
            $components_string .= $components[$i];
            $i++;
            if($i<$components_number){
                $components_string .= ",";
            }
        }
        $newSpell->components = $components_string;
        $newSpell->duration = $durations[array_rand($durations)];
        $newSpell->description = fake()->paragraph();

        $newSpell->save();
    }
}
