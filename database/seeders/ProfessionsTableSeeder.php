<?php

namespace Database\Seeders;

use App\Models\Profession;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $file = file_get_contents(database_path('data/professions.json'));
        $professions = json_decode($file,true);
        

        foreach($professions as $profession){
            $newProfession = Profession::create([
                "name"=>$profession['name'],
                "primary_ability"=>$profession['primary_ability'],
                "hit_points_die"=>$profession['hit_points_die'],
                "hit_points_at_level_1"=>$profession['hit_points_at_level_1'],
                "armor_training"=>$profession['armor_training'],
                "starting_equipment"=>$profession['starting_equipment'],
                "saving_throws"=>$profession['saving_throws'],
                "description"=>$profession['description'],
                "number_of_skill_proficiencies"=>$profession['number_of_skill_proficiencies'],
                "number_of_tool_proficiencies"=>$profession['number_of_tool_proficiencies'],
                "type_of_tool_proficiencies"=>$profession['type_of_tool_proficiencies'],
                "image"=>$profession['image'],            
                ]);
            $newProfession->proficiencies()->attach($profession['proficiencies']);
            $newProfession->features()->attach($profession['features']);
            if(array_key_exists('spells',$profession)){
                $newProfession->spells()->attach($profession['spells']);
            }

        }
    }
}
