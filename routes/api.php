<?php

use App\Http\Controllers\Api\CharacterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('/characters', [CharacterController::class, 'index']);
