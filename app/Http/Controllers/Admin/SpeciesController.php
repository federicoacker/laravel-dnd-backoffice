<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SpeciesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $species = Species::all();
        return view('species.index', compact('species'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $features = Feature::where('type', 'LIKE', 'Species')->get();
        return view('species.create', compact('features'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'features' => 'required|array|min:1',
        ], [
            'features.required' => 'Devi selezionare almeno una feature.',
        ]);
        $data = $request->all();
        $newSpecies = new Species();
        $newSpecies->name = $data['name'];
        $newSpecies->description = $data['description'];
        if(array_key_exists('image', $data)){
            $img_path = Storage::putFile('species', $data['image']);
            $newSpecies->image = $img_path;
        }
        $newSpecies->save();
        $newSpecies->features()->attach($data['features']);

        return redirect()->route('species.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Species $species)
    {
        return view('species.show', compact('species'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Species $species)
    {
        $features = Feature::where('type', 'LIKE', 'Species')->get();
        return view('species.edit', compact('species', 'features'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Species $species)
    {
        $validated = $request->validate([
            'features' => 'required|array|min:1',
        ], [
            'features.required' => 'Devi selezionare almeno una feature.',
        ]);
        $data = $request->all();

        $species->name = $data['name'];
        $species->description = $data['description'];
        if(array_key_exists('image', $data)){
            if($species->image){
                Storage::delete($species->image);
            }

            $img_path = Storage::putFile('species', $data['image']);
            $species->image = $img_path;
        }
        $species->update();
        $species->features()->sync($data['features']);
        
        return redirect()->route("species.show", $species);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Species $species)
    {
        if($species->image){
            Storage::delete($species->image);
        }
        $species->delete();
        return redirect()->route('species.index');
    }
}
