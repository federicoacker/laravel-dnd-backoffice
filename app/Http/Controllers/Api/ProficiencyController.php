<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Proficiency;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class ProficiencyController extends Controller
{
    use HttpResponses;
    public function index(){
        $proficiencies = Proficiency::all();
        return $this->success($proficiencies);
    }
}
