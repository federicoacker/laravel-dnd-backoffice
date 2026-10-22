<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feat;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class FeatController extends Controller
{
    use HttpResponses;
    public function index(Request $request)
    {

        $search = $request->query('search');
        $query = Feat::query();
        
        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }
        $mapFeats = function ($feat) {
            return [
                'id' => $feat->id,
                'name' => $feat->name,
                'description' => $feat->description,
            ];
        };

        if (!$request->boolean('paginate', false)) {
            return $this->success([
                'data' => $query->get()->map($mapFeats),
            ]);
        }

        $features = $query->paginate(21);
        $features->through($mapFeats);
        return $this->success([
            'data' => $features->items(),
            'current_page' => $features->currentPage(),
            'last_page' => $features->lastPage()
        ]);
    }
}
