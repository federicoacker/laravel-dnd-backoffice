<?php

namespace Database\Seeders;

use App\Models\Feature;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeaturesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $json_file = file_get_contents(database_path('data/features.json'));
        $features = json_decode($json_file, true);
        foreach ($features as $feature) {
            Feature::create([
                'name' => $feature['name'],
                'description' =>$feature['description'],
                'type' => $feature['type']
            ]);
        }
    }
}
