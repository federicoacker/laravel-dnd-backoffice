<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Character;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class CharacterController extends Controller
{

    use HttpResponses;
    public function index(Request $request)
    {
        $user = $request->user('sanctum');
        $query = Character::with([
            'species',
            'profession',
            'background',
            'proficiencies',
        ]);
        if ($user && $user->role === 'admin') {
            //Non applichiamo nessun filtro in questo caso
        } elseif ($user) {
            //Restituiamo solo i personaggi appartenenti all'utente o quelli pubblici
            $query->where('user_id', $user->id)->orWhere('is_public', true);
        } else {
            //Restituiamo solo quelli pubblici (caso guest)
            $query->where('is_public', true);
        }

        $characters = $query->get();

        if (count($characters) > 0) {
            return $this->success($characters);
        } else {
            return $this->error([], "0 Characters Found", 404);
        }
    }

    public function show(Request $request)
    {
        $user = $request->user('sanctum');
        $character_id = $request->character;
        $character = Character::with(
            'species', 
            'species.features', 
            'profession', 
            'profession.features', 
            'profession.spells', 
            'background', 
            'proficiencies', 
            'feats')
            
            ->find($character_id);

        if ($user && $user->role == 'admin') {

            return $this->success($character);

        } elseif ($user) {

            if ($character->user_id != $user->id && !$character->is_public) {
                return $this->error([], "You don't have access to this character", 403);
            }

            return $this->success($character);

        } else {

            if ($character->is_public) {
                return $this->success($character);
            }
            return $this->error([], "You don't have access to this character", 403);
            
        }
    }
}
