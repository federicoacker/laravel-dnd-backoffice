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
})->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');

// Rotte accessibili solo da admin
Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {

    Route::resource('spells', SpellController::class);

    Route::resource('features', FeatureController::class);

    Route::resource('species', SpeciesController::class);

    Route::resource('proficiencies', ProficiencyController::class);

    Route::resource('feats', FeatController::class);

    Route::resource('backgrounds', BackgroundController::class);

    Route::resource('classes', ProfessionController::class);

    Route::resource('characters', CharacterController::class);

    Route::match(['get', 'post'], '/characters/create/step2', [CharacterController::class, 'create2'])->name('characters.create2');

    Route::match(['get', 'post'], '/characters/{character}/edit/step2', [CharacterController::class, 'edit2'])->name('characters.edit2');
});

require __DIR__ . '/auth.php';
