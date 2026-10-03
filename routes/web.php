<?php

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

require __DIR__.'/auth.php';
