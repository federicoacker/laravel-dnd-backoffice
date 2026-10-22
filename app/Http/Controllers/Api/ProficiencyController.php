<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proficiency;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ProficiencyController extends Controller
{
    use HttpResponses;
    public function index(Request $request){
        $search = $request->query('search');
        $query = Proficiency::query();
        
        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }
        $mapProficiencies = function ($proficiency) {
            return [
                'id' => $proficiency->id,
                'name' => $proficiency->name,
                'description' => $proficiency->description,
                'type' => $proficiency->type,
                'ability_score' => $proficiency->ability_score
            ];
        };

        if (!$request->boolean('paginate', false)) {
            return $this->success([
                'data' => $query->get()->map($mapProficiencies),
            ]);
        }

        $features = $query->paginate(21);
        $features->through($mapProficiencies);
        return $this->success([
            'data' => $features->items(),
            'current_page' => $features->currentPage(),
            'last_page' => $features->lastPage()
        ]);
    }
}
