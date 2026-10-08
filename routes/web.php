<?php

use App\Http\Controllers\Admin\BackgroundController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Admin\FeatController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ProficiencyController;
use App\Http\Controllers\Admin\ProfessionController;
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

Route::resource('backgrounds', BackgroundController::class)
->middleware(['auth', 'verified']);

Route::resource('classes', ProfessionController::class)
->middleware(['auth', 'verified']);

Route::resource('characters', CharacterController::class)
->middleware(['auth', 'verified']);

Route::match(['get', 'post'], '/characters/create/step2', [CharacterController::class, 'create2'])
->middleware(['auth','verified'])
->name('characters.create2');

Route::match(['get', 'post'], '/characters/{character}/edit/step2', [CharacterController::class, 'edit2'])
->middleware(['auth','verified'])
->name('characters.edit2');

require __DIR__.'/auth.php';
