<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Background;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class BackgroundController extends Controller
{   
    use HttpResponses;
    public function index(Request $request){
        $search = $request->query('search');
        $query = Background::with('feat');
        
        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }

        $mapBackgrounds = function ($background) {
            return [
                'id' => $background->id,
                'name' => $background->name,
                'feat' => $background->feat,
                'description' => $background->description,
                'equipment' => $background->equipment,
                'ability_scores' => $background->ability_scores
            ];
        };

        if (!$request->boolean('paginate', false)) {
            return $this->success([
                'data' => $query->get()->map($mapBackgrounds),
            ]);
        }

        $backgrounds = $query->paginate(6);
        $backgrounds->through($mapBackgrounds);
        return $this->success([
            'data' => $backgrounds->items(),
            'current_page' => $backgrounds->currentPage(),
            'last_page' => $backgrounds->lastPage()
        ]);
    }

    public function show(Request $request){
        $background_id = $request->background;
        $background = Background::with('feat','proficiencies')->findOrFail($background_id);


        return $this->success($background);
    }
}
