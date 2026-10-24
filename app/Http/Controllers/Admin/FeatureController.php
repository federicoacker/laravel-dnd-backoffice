<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feature;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = Feature::all();
        return view('features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $newFeature = new Feature();
        $newFeature->name = $data['name'];
        $newFeature->description = $data['description'];
        $newFeature->type = $data['type'];

        $newFeature->save();

        return redirect()->route('features.show', $newFeature);
    }

    /**
     * Display the specified resource.
     */
    public function show(Feature $feature)
    {
        return view('features.show', compact('feature'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Feature $feature)
    {
        return view('features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Feature $feature)
    {
        $data = $request->all();

        $feature->name = $data['name'];
        $feature->description = $data['description'];
        $feature->type = $data['type'];

        $feature->update();

        return redirect()->route('features.show', $feature);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Feature $feature)
    {
        $feature->delete();

        return redirect()->route('features.index');
    }
}
