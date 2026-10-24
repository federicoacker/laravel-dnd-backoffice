<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feat;
use Illuminate\Http\Request;

class FeatController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $feats = Feat::all();
        return view('feats.index', compact('feats'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('feats.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $newFeat = new Feat();
        $newFeat->name = $data['name'];
        $newFeat->description = $data['description'];

        $newFeat->save();

        return redirect()->route('feats.show', $newFeat);
    }

    /**
     * Display the specified resource.
     */
    public function show(Feat $feat)
    {
        return view('feats.show', compact('feat'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feat $feat)
    {
        return view('feats.edit', compact('feat'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feat $feat)
    {
        $data = $request->all();

        $feat->name = $data['name'];
        $feat->description = $data['description'];

        $feat->update();

        return redirect()->route('feats.show', $feat);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feat $feat)
    {
        $feat->delete();

        return redirect()->route('feats.index');
    }
}
