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
        $file = file_get_contents(database_path('data/spells.json'));
        $spells = json_decode($file, true);

        foreach($spells as $spell){
            $newSpell = Spell::create([
                "name" => $spell['name'],
                "level" => $spell['level'],
                "casting_time" => $spell['casting_time'],
                "range" => $spell['range'],
                "components" => $spell['components'],
                "duration" => $spell['duration'],
                "description" => $spell['description']
            ]);

            $newSpell->professions()->attach($spell['profession_ids']);
        }
    }
}
