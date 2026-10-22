<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    use HttpResponses;
    public function index(Request $request){
        $search = $request->query('search');
        $query = Feature::query();
        
        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }
        $mapFeatures = function ($feature) {
            return [
                'id' => $feature->id,
                'name' => $feature->name,
                'description' => $feature->description,
            ];
        };

        if (!$request->boolean('paginate', false)) {
            return $this->success([
                'data' => $query->get()->map($mapFeatures),
            ]);
        }

        $features = $query->paginate(21);
        $features->through($mapFeatures);
        return $this->success([
            'data' => $features->items(),
            'current_page' => $features->currentPage(),
            'last_page' => $features->lastPage()
        ]);
    }
}
