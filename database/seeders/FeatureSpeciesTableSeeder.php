<?php

namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatureSpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $species = Species::all();
        $features = json_decode(file_get_contents(database_path('data/features.json')), true);
        $features = array_filter($features,  function($feature){
            return $feature['type'] == 'Species';
        });

        foreach($species as $specie){
            $features_for_this_species = array_filter($features, function($feature) use($specie){
                return $feature['species_id'] == $specie->id;
            });

            $feature_ids = array_map(function($feature){
                return $feature['id'];
            }, $features_for_this_species);

            $specie->features()->attach($feature_ids);
        }

    }
}
