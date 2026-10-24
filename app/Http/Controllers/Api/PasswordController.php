<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class PasswordController extends Controller
{
    use HttpResponses;

    public function update(Request $request)
{
    $validated = $request->validate([
        'current_password' => ['required', 'current_password'],
        'password' => ['required', Password::defaults(), 'confirmed'],
    ]);

    $request->user()->update([
        'password' => Hash::make($validated['password']),
    ]);

    return $this->success(null,'Password updated.');
}
}
