<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Background;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class BackgroundController extends Controller
{   
    use HttpResponses;
    public function index(){
        $backgrounds = Background::with('feat')->get();

        $mappedBackgrounds = $backgrounds->map(function ($background) {
            return [
                'id' => $background->id,
                'name' => $background->name,
                'feat' => $background->feat,
                'equipment' => $background->equipment
            ];
        });

        return $this->success($mappedBackgrounds);
    }
}
