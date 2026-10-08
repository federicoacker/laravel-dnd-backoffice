<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Background;
use App\Models\Character;
use App\Models\Feat;
use App\Models\Profession;
use App\Models\Proficiency;
use App\Models\Species;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $characters = Character::all();
        return view('characters.index', compact('characters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $professions = Profession::all();
        $backgrounds = Background::all();
        $species = Species::all();

        return view('characters.create', compact('professions', 'backgrounds', 'species', ));
    }

    public function create2(Request $request)
    {

        $name = old('name', $request->input('name'));
        $level = old('level', $request->input('level'));
        $professionId = old('profession_id', $request->input('profession_id'));
        $backgroundId = old('background_id', $request->input('background_id'));
        $speciesId = old('species_id', $request->input('species_id'));


        $profession = Profession::find($professionId);
        $background = Background::find($backgroundId);
        $species = Species::find($speciesId);
        $feats = Feat::all();


        if (!$profession || !$background || !$species) {
            return redirect()->route('characters.create')->with('error', 'Sessione scaduta. Ricomincia la creazione.');
        }

        return view('characters.create2', compact('name', 'level', 'profession', 'background', 'species', 'feats'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $profession = Profession::find($request->input('profession_id'));

        $validated = $request->validate(
            [
                'profession_id' => ['required', 'exists:professions,id'],
                'name' => ['required', 'string'],
                'level' => ['required', 'integer'],
                'profession_proficiencies' => ['required', 'array', 'size:' . ($profession?->number_of_proficiencies ?? 0)],
                'feats' => ['array', 'size:' . floor($data['level'] / 4)]
            ],
            [
                'profession_proficiencies.required' => "Devi selezionare le proficiencies di classe.",
                'profession_proficiencies.size' => "Devi selezionare esattamente il numero di proficiencies della tua classe.",
                'feats.size' => "Devi selezionare " . floor($data['level'] / 4) . " feat"
            ]
        );

        $newCharacter = new Character();
        $newCharacter->name = $data['name'];
        $newCharacter->level = $data['level'];
        $newCharacter->species_id = $data['species_id'];
        $newCharacter->profession_id = $data['profession_id'];
        $newCharacter->background_id = $data['background_id'];

        $newCharacter->strength = $data['strength'] ?? 10;
        $newCharacter->dexterity = $data['dexterity'] ?? 10;
        $newCharacter->constitution = $data['constitution'] ?? 10;
        $newCharacter->intellect = $data['intellect'] ?? 10;
        $newCharacter->wisdom = $data['wisdom'] ?? 10;
        $newCharacter->charisma = $data['charisma'] ?? 10;
        $newCharacter->backstory = $data['backstory'] ?? null;
        $newCharacter->inventory = $data['inventory'] ?? null;

        if ($request->hasFile('image')) {
            $img_path = Storage::putFile('characters', $request->file('image'));
            $newCharacter->image = $img_path;
        }
        $proficiencies = array_merge($data['profession_proficiencies'], $data['background_proficiencies']);
        $newCharacter->save();

        $newCharacter->proficiencies()->attach($proficiencies);

        $background_feat = Background::find($data['background_id'])->feat->id;

        $feats = $data['feats'];
        $feats[] = $background_feat;

        $newCharacter->feats()->attach($feats);

        return redirect()->route('characters.show', $newCharacter)->with('success', 'Carattere creato con successo!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Character $character)
    {
        $skill_proficiencies = Proficiency::where('type', 'LIKE', 'Skill')->orderBy('name')->get();
        $tool_proficiencies = Proficiency::where('type', 'LIKE', 'Tool')->orderBy('name')->get();
        return view('characters.show', compact('character', 'skill_proficiencies', 'tool_proficiencies'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Character $character)
    {
        $professions = Profession::all();
        $backgrounds = Background::all();
        $species = Species::all();

        return view('characters.edit', compact('character', 'professions', 'backgrounds', 'species'));
    }
    public function edit2(Request $request, Character $character)
    {
        $name = old('name', $request->input('name'));
        $level = old('level', $request->input('level'));
        $professionId = old('profession_id', $request->input('profession_id'));
        $backgroundId = old('background_id', $request->input('background_id'));
        $speciesId = old('species_id', $request->input('species_id'));

        $profession = Profession::find($professionId);
        $background = Background::find($backgroundId);
        $species = Species::find($speciesId);
        $feats = Feat::all();


        if (!$profession || !$background || !$species) {
            return redirect()->route('characters.edit')->with('error', 'Sessione scaduta. Ricomincia la modifica.');
        }

        return view('characters.edit2', compact('name', 'level', 'profession', 'background', 'species', 'feats', 'character'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Character $character)
    {
        $data = $request->all();
        $profession = Profession::find($request->input('profession_id'));

        $validated = $request->validate(
            [
                'profession_id' => ['required', 'exists:professions,id'],
                'name' => ['required', 'string'],
                'level' => ['required', 'integer'],
                'profession_proficiencies' => ['required', 'array', 'size:' . ($profession?->number_of_proficiencies ?? 0)],
                'feats' => ['array', 'size:' . floor($data['level'] / 4)]
            ],
            [
                'profession_proficiencies.required' => "Devi selezionare le proficiencies di classe.",
                'profession_proficiencies.size' => "Devi selezionare esattamente il numero di proficiencies della tua classe.",
                'feats.size' => "Devi selezionare " . floor($data['level'] / 4) . " feat"
            ]
        );

        $character->name = $data['name'];
        $character->level = $data['level'];
        $character->species_id = $data['species_id'];
        $character->profession_id = $data['profession_id'];
        $character->background_id = $data['background_id'];

        $character->strength = $data['strength'] ?? 10;
        $character->dexterity = $data['dexterity'] ?? 10;
        $character->constitution = $data['constitution'] ?? 10;
        $character->intellect = $data['intellect'] ?? 10;
        $character->wisdom = $data['wisdom'] ?? 10;
        $character->charisma = $data['charisma'] ?? 10;
        $character->backstory = $data['backstory'] ?? null;
        $character->inventory = $data['inventory'] ?? null;

        if ($request->hasFile('image')) {
            if($character->image){
                Storage::delete($character->image);
            }
            $img_path = Storage::putFile('characters', $request->file('image'));
            $character->image = $img_path;
        }
        $proficiencies = array_merge($data['profession_proficiencies'], $data['background_proficiencies']);
        $character->update();

        $character->proficiencies()->sync($proficiencies);

        $background_feat = Background::find($data['background_id'])->feat->id;

        $feats = $data['feats'];
        $feats[] = $background_feat;

        $character->feats()->sync($feats);

        return redirect()->route('characters.show', $character)->with('success', 'Carattere creato con successo!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Character $character)
    {
        if ($character->image) {
            Storage::delete($character->image);
        }
        $character->delete();

        return redirect()->route('characters.index');
    }
}
