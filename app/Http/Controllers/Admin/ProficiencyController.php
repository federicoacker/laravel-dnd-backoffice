<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Proficiency;
use Illuminate\Http\Request;

class ProficiencyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $proficiencies = Proficiency::all();

        return view('proficiencies.index', compact('proficiencies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('proficiencies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newProficiency = new Proficiency();
        $newProficiency->name = $data['name'];
        $newProficiency->description = $data['description'];
        $newProficiency->type = $data['type'];
        if($data['ability_score']){
            $newProficiency->ability_score = $data['ability_score'];
        }

        $newProficiency->save();

        return redirect()->route('proficiencies.show', $newProficiency);
    }

    /**
     * Display the specified resource.
     */
    public function show(Proficiency $proficiency)
    {
        return view('proficiencies.show', compact('proficiency'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proficiency $proficiency)
    {
        return view('proficiencies.edit', compact('proficiency'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proficiency $proficiency)
    {
        $data = $request->all();
        
        $proficiency->name = $data['name'];
        $proficiency->description = $data['description'];
        $proficiency->type = $data['type'];
        $proficiency->ability_score = $data['ability_score'];

        $proficiency->update();

        return redirect()->route('proficiencies.show', $proficiency);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proficiency $proficiency)
    {
        $proficiency->delete();
        return redirect()->route('proficiencies.index');
    }
}
