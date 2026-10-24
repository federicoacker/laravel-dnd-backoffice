<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Psy\CodeCleaner\FunctionReturnInWriteContextPass;

class UserController extends Controller
{
    use HttpResponses;

    public function show(Request $request)
    {
        $user = $request->user('sanctum');
        $user_to_find_id = $request->user;
        $user_to_return = User::with('characters', 'characters.profession', 'characters.background', 'characters.species')->findOrFail($user_to_find_id);

        $mapCharacters = function ($character) {
            return [
                "id" => $character->id,
                "is_public" => $character->is_public,
                "name" => $character->name,
                "level" => $character->level,
                "background" => $character->background,
                "species" => $character->species,
                "profession" => $character->profession,
                "backstory" => $character->backstory,
                "image" => $character->image ? asset('storage/' . $character->image) : null,
                "strength" => $character->strength,
                "dexterity" => $character->dexterity,
                "constitution" => $character->constitution,
                "intellect" => $character->intellect,
                "wisdom" => $character->wisdom,
                "charisma" => $character->charisma,
                "inventory" => $character->inventory,
                "proficiencies" => $character->proficiencies,
                "user_id" => $character->user_id
            ];
        };

        if ($user_to_return->id != $user->getAuthIdentifier() && $user->role != "admin") {
            abort(403, "You are not authorized to see this user");
        }

        $mappedUser = [
            "name" => $user_to_return->name,
            "email" => $user_to_return->email,
            "characters" => $user_to_return->characters->map($mapCharacters)
        ];

        return $this->success($mappedUser);
    }
}
