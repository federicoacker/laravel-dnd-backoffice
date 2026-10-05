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
        $newFeature = new Feature();
        $newFeature->name = fake()->word();
        $newFeature->description = fake()->paragraph();
        $newFeature->type = "Species";
        $newFeature->save();
    }
}
