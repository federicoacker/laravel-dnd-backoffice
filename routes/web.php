<?php

use App\Http\Controllers\Admin\BackgroundController;
use App\Http\Controllers\Admin\CharacterController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\FeatController;
use App\Http\Controllers\Admin\FeatureController;
use App\Http\Controllers\Admin\ProficiencyController;
use App\Http\Controllers\Admin\ProfessionController;
use App\Http\Controllers\Admin\SpeciesController;
use App\Http\Controllers\Admin\SpellController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified', 'role:admin'])->name('dashboard');



// Rotte accessibili solo da admin

Route::middleware(['auth', 'verified', 'role:admin'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::match(['put', 'patch'], '/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

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
