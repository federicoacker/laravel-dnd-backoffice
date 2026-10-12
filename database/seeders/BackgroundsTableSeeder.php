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
        $file = file_get_contents(database_path('data/backgrounds.json'));
        $backgrounds = json_decode($file, true);

        foreach($backgrounds as $background){
            $newBackground = Background::create([
                'name' => $background['name'],
                'feat_id' => $background['feat_id'],
                'ability_scores' => $background['ability_scores'],
                'equipment' => $background['equipment'],
                'description' => $background['description']
            ]);

            $newBackground->proficiencies()->attach($background['proficiencies']);
        }
    }
}
