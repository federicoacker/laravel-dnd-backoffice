<?php

namespace Database\Seeders;

use App\Models\Feat;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FeatsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newFeat = new Feat();
        $newFeat->name = fake()->word();
        $newFeat->description = fake()->paragraph;
        $newFeat->save();
    }
}
