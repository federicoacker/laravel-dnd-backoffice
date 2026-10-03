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
        $newSpecies = new Species();
        $newSpecies->name = fake()->word();
        $newSpecies->description = fake()->paragraph();
        $newSpecies->save();
    }
}
