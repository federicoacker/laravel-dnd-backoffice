<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use App\Models\Profession;
use App\Models\Proficiency;
use App\Models\Spell;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $professions = Profession::all();
        return view('professions.index', compact('professions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proficiencies = Proficiency::orderBy('type')->get();
        $features = Feature::where('type', 'LIKE', 'Profession')->get();
        $spells = Spell::orderBy('level', 'asc')->get();
        return view('professions.create', compact('proficiencies', 'features', 'spells'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'features' => 'required|array|min:1',
            'proficiencies' => 'required|array|min:1',
        ], [
            'features.required' => 'Devi selezionare almeno una feature.',
            'proficiencies.required' => 'Devi selezionare almeno una proficiency.',
        ]);

        $data = $request->all();
        $newProfession = new Profession();
        $newProfession->name = $data['name'];
        $newProfession->description = $data['description'];
        $newProfession->primary_ability = $data['primary_ability'];
        $newProfession->hit_points_die = $data['hit_points_die'];
        $newProfession->hit_points_at_level_1 = $data['hit_points_at_level_1'];
        $newProfession->armor_training = $data['armor_training'];
        $newProfession->number_of_proficiencies = $data['number_of_proficiencies'];
        $newProfession->starting_equipment = $data['starting_equipment'];

        if ($request->has('image')) {
            $img_path = Storage::putFile('professions', $data['image']);
            $newProfession->image = $img_path;
        }

        $newProfession->save();

        $newProfession->proficiencies()->attach($data['proficiencies']);
        $newProfession->features()->attach($data['features']);

        if ($request->has('spells')) {
            $newProfession->spells()->attach($data['spells']);
        }

        return redirect()->route('classes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Profession $class)
    {
        return view('professions.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Profession $class)
    {

        $proficiencies = Proficiency::orderBy('type')->get();
        $features = Feature::where('type', 'LIKE', 'Profession')->get();
        $spells = Spell::orderBy('level', 'asc')->get();
        return view('professions.edit', compact('class', 'proficiencies', 'features', 'spells'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Profession $class)
    {

        $validated = $request->validate([
            'features' => 'required|array|min:1',
            'proficiencies' => 'required|array|min:1',
        ], [
            'features.required' => 'Devi selezionare almeno una feature.',
            'proficiencies.required' => 'Devi selezionare almeno una proficiency.',
        ]);

        $data = $request->all();

        $class->name = $data['name'];
        $class->description = $data['description'];
        $class->primary_ability = $data['primary_ability'];
        $class->hit_points_die = $data['hit_points_die'];
        $class->hit_points_at_level_1 = $data['hit_points_at_level_1'];
        $class->armor_training = $data['armor_training'];
        $class->number_of_proficiencies = $data['number_of_proficiencies'];
        $class->starting_equipment = $data['starting_equipment'];

        if ($request->has('image')) {
            if ($class->image) {
                Storage::delete($class->image);
            }
            $img_path = Storage::putFile('professions', $data['image']);
            $class->image = $img_path;
        }

        $class->update();

        $class->proficiencies()->sync($data['proficiencies']);
        $class->features()->sync($data['features']);

        if ($request->has('spells')) {
            $class->spells()->sync($data['spells']);
        } else {
            $class->spells()->detach();
        }

        return redirect()->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Profession $class)
    {
        if($class->image){
            Storage::delete($class->image);
        }
        $class->delete();

        return redirect()->route('classes.index');
    }
}
