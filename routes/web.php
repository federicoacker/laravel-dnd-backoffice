<?php

use App\Http\Controllers\Admin\FeatController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ProficiencyController;
use App\Http\Controllers\Admin\SpeciesController;
use App\Http\Controllers\Admin\SpellController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::resource('spells', SpellController::class)
->middleware(['auth', 'verified']);

Route::resource('features', FeatureController::class)
->middleware(['auth', 'verified']);

Route::resource('species', SpeciesController::class)
->middleware(['auth', 'verified']);

Route::resource('proficiencies', ProficiencyController::class)
->middleware(['auth', 'verified']);

Route::resource('feats', FeatController::class)
->middleware(['auth', 'verified']);

require __DIR__.'/auth.php';
