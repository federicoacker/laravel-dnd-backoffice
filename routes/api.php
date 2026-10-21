<?php

use App\Http\Controllers\Api\BackgroundController;
use App\Http\Controllers\Api\CharacterController;
use App\Http\Controllers\Api\FeatController;
use App\Http\Controllers\Api\ProfessionController;
use App\Http\Controllers\Api\ProficiencyController;
use App\Http\Controllers\Api\SpeciesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TasksController;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');



//public routes
Route::post('/login', [AuthController::class, 'login'])
->middleware('throttle:10,1');
Route::post('/register', [AuthController::class, 'register'])
->middleware('throttle:10,1');

Route::get('/characters', [CharacterController::class, 'index']);
Route::get('/characters/{character}', [CharacterController::class, 'show']);
Route::match(['put', 'patch'], '/characters/{character}', [CharacterController::class, 'update'])
    ->middleware(['auth:sanctum', 'throttle:60,1']);
Route::post('/characters', [CharacterController::class, 'store'])
    ->middleware(['auth:sanctum', 'throttle:60,1']);

Route::get('/classes', [ProfessionController::class, 'index']);
Route::get('/backgrounds', [BackgroundController::class, 'index']);
Route::get('/species', [SpeciesController::class, 'index']);

Route::get('/proficiencies', [ProficiencyController::class, 'index']);
Route::get('/feats', [FeatController::class, 'index']);

//protected routes
Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::post('/logout', [AuthController::class, 'logout']);

});
