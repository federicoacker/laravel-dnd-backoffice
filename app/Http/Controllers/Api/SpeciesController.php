<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Species;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    use HttpResponses;
    public function index(Request $request)
    {
        $query = Species::with('features');

        $mapSpecies = function ($species) {
            return [
                'id' => $species->id,
                'name' => $species->name,
                'features' => $species->features,
                'description' => $species->description,
            ];
        };

        if (!$request->boolean('paginate', true)) {
            return $this->success([
                'data' => $query->get()->map($mapSpecies),
            ]);
        }

        $species = $query->paginate(6);
        $species->through($mapSpecies);

        return $this->success([
            'data' => $species->items(),
            'current_page' => $species->currentPage(),
            'last_page' => $species->lastPage(),
        ]);
    }
}
