<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Spell;
use Illuminate\Http\Request;

class SpellController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $spells = Spell::all();

        return view('spells.index', compact('spells'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spells.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newSpell = new Spell();
        $newSpell->name = $data['name'];
        $newSpell->level = $data['level'];
        $newSpell->casting_time = $data['casting_time'];
        $newSpell->range = $data['range'];
        $components_string = "";
        if (array_key_exists('components', $data)) {
            $i = 0;
            while ($i < count($data['components'])) {
                $components_string .= $data['components'][$i];
                $i++;
                if ($i < count($data['components'])) {
                    $components_string .= ",";
                }
            }
        }
        $newSpell->components = $components_string;
        $newSpell->duration = $data['duration'];
        $newSpell->description = $data['description'];

        $newSpell->save();

        return redirect()->route('spells.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Spell $spell)
    {
        return view('spells.show', compact('spell'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Spell $spell)
    {
        return view('spells.edit', compact('spell'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Spell $spell)
    {
        $data = $request->all();

        $spell->name = $data['name'];
        $spell->level = $data['level'];
        $spell->casting_time = $data['casting_time'];
        $spell->range = $data['range'];
        $spell->duration = $data['duration'];
        $spell->description = $data['description'];
        $components_string = "";
        if (array_key_exists('components', $data)) {
            $i = 0;
            while ($i < count($data['components'])) {
                $components_string .= $data['components'][$i];
                $i++;
                if ($i < count($data['components'])) {
                    $components_string .= ",";
                }
            }
        }
        $spell->components = $components_string;

        $spell->update();
        return redirect()->route('spells.show', $spell);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Spell $spell)
    {
        $spell->delete();
        return redirect()->route('spells.index');
    }
}
