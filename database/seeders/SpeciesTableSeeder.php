<?php

namespace Database\Seeders;

use App\Models\Species;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SpeciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = file_get_contents(database_path('data/species.json'));
        $species = json_decode($file, true);

        foreach($species as $specie){
            Species::create([
                "name" => $specie['name'],
                "description" => $specie['description'],
                "image"=> $specie['image']
            ]);
        }
    }
}
