<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CharactersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newCharacter = new Character();
        $newCharacter->name = fake()->name();
        $newCharacter->level = rand(1,20);
        $newCharacter->background_id = 1;
        $newCharacter->species_id = 1;
        $newCharacter->profession_id = 1;
        $newCharacter->backstory = fake()->paragraph();
        $newCharacter->strength = rand(10,20);
        $newCharacter->dexterity = rand(10,20);
        $newCharacter->constitution = rand(10,20);
        $newCharacter->intellect = rand(10,20);
        $newCharacter->wisdom = rand(10,20);
        $newCharacter->charisma = rand(10,20);
        $newCharacter->inventory = fake()->paragraph();

        $newCharacter->save();
    }
}
