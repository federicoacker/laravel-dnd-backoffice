<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Background;
use App\Models\Feat;
use App\Models\Proficiency;
use Illuminate\Http\Request;

class BackgroundController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $backgrounds = Background::all();
        return view('backgrounds.index', compact('backgrounds'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $proficiencies = Proficiency::all();
        $feats = Feat::all();
        return view('backgrounds.create', compact('feats', 'proficiencies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'ability_scores' => 'required|array|min:1',
        ], [
            'ability_scores.required' => "Devi selezionare almeno un'abilità associata.",
        ]);

        $data = $request->all();

        $newBackground = new Background();
        $newBackground->name = $data['name'];
        $newBackground->description = $data['description'];
        $newBackground->equipment = $data['equipment'];

        $abilities_string = "";
        $i = 0;
        while ($i < count($data['ability_scores'])) {
            $abilities_string .= $data['ability_scores'][$i];
            $i++;
            if ($i < count($data['ability_scores'])) {
                $abilities_string .= ",";
            }
        }

        $newBackground->ability_scores = $abilities_string;
        $newBackground->feat_id = $data['feat_id'];

        $newBackground->save();

        if ($request->has('proficiencies')) {
            $newBackground->proficiencies()->attach($data['proficiencies']);
        }

        return redirect()->route('backgrounds.show', $newBackground);
    }

    /**
     * Display the specified resource.
     */
    public function show(Background $background)
    {
        return view('backgrounds.show', compact('background'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Background $background)
    {
        $feats = Feat::all();
        $proficiencies = Proficiency::all();
        return view('backgrounds.edit', compact('background', 'feats', 'proficiencies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Background $background)
    {
        $validated = $request->validate([
            'ability_scores' => 'required|array|min:1',
        ], [
            'ability_scores.required' => "Devi selezionare almeno un'abilità associata.",
        ]);

        $data = $request->all();

        $background->name = $data['name'];
        $background->description = $data['description'];
        $background->equipment = $data['equipment'];
        $background->feat_id = $data['feat_id'];

        $abilities_string = "";
        $i = 0;
        while ($i < count($data['ability_scores'])) {
            $abilities_string .= $data['ability_scores'][$i];
            $i++;
            if ($i < count($data['ability_scores'])) {
                $abilities_string .= ",";
            }
        }

        $background->ability_scores = $abilities_string;

        $background->update();

        if ($request->has('proficiencies')) {
            $background->proficiencies()->sync($data['proficiencies']);
        }

        return redirect()->route('backgrounds.show', $background);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Background $background)
    {
        $background->delete();

        return redirect()->route('backgrounds.index');
    }
}
