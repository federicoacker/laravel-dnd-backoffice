<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    use HttpResponses;
    public function index(Request $request)
    {

        $search = $request->query('search');
        $query = Profession::with('proficiencies', 'features', 'spells');

        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $mapProfessions = function ($profession) {
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
        };

        if (!$request->boolean('paginate', false)) {
            return $this->success([
                'data' => $query->get()->map($mapProfessions),
            ]);
        }

        $professions = $query->paginate(6);
        $professions->through($mapProfessions);

        return $this->success([
            'data' => $professions->items(),
            'current_page' => $professions->currentPage(),
            'last_page' => $professions->lastPage(),
        ]);

    }

    public function show(Request $request){
        $profession_id = $request->profession;
        $profession = Profession::with('features','proficiencies','spells')->findOrFail($profession_id);


        return $this->success($profession);
    }
}
