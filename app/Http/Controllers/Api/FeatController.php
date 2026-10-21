<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feat;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class FeatController extends Controller
{
    use HttpResponses;
    public function index(){
        $feats = Feat::all();

        return $this->success($feats);
    }
}
