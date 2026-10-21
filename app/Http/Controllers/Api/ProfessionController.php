<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    use HttpResponses;
    public function index() {
        $professions = Profession::with('proficiencies', 'features', 'spells')->get();
        
        $mappedProfessions = $professions->map(function ($profession) {
            return [
                'id' => $profession->id,
                'name' => $profession->name,
                'primary_ability' => $profession->primary_ability,
                'hit_points_die' => $profession->hit_points_die,
                'hit_points_at_level_1' => $profession->hit_points_at_level_1,
                'saving_throws' => $profession->saving_throws,
                'armor_training' => $profession->armor_training,
                'starting_equipment' => $profession->starting_equipment,
                'description' => $profession->description,
                'number_of_skill_proficiencies' => $profession->number_of_skill_proficiencies,
                'number_of_tool_proficiencies' => $profession->number_of_tool_proficiencies,
                'type_of_tool_proficiencies' => $profession->type_of_tool_proficiencies,
                'image' => $profession->image ? asset('storage/' . $profession->image) : null,
                'proficiencies' => $profession->proficiencies,
                'features' => $profession->features,
                'spells' => $profession->spells
            ];
        });

        return $this->success($mappedProfessions);
    }
}
