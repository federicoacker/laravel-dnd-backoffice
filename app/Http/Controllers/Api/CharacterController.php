<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Background;
use App\Models\Character;
use App\Models\Profession;
use App\Models\Species;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CharacterController extends Controller
{

    use HttpResponses;
    public function index(Request $request)
    {
        $search = $request->query('search');
        $classes = array_filter(array_map('trim', explode(',', $request->query('classes', 'any'))));
        $backgrounds = array_filter(array_map('trim', explode(',', $request->query('backgrounds', 'any'))));
        $species = array_filter(array_map('trim', explode(',', $request->query('species', 'any'))));

        $query = Character::with([
            'species',
            'profession',
            'background',
            'proficiencies',
        ]);

        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }

        if ($classes && !in_array('any', $classes, true)) {
            $classIds = Profession::whereIn('name', $classes)->pluck('id');
            $query->whereIn('profession_id', $classIds);
        }

        if ($backgrounds && !in_array('any', $backgrounds, true)) {
            $backgroundIds = Background::whereIn('name', $backgrounds)->pluck('id');
            $query->whereIn('background_id', $backgroundIds);
        }

        if ($species && !in_array('any', $species, true)) {
            $speciesIds = Species::whereIn('name', $species)->pluck('id');
            $query->whereIn('species_id', $speciesIds);
        }

        $user = $request->user('sanctum');
        $scope = $request->query('scope', 'public');

        if ($scope === 'mine') {
            abort_unless($user, 401);
            $query->where('user_id', $user->id);
        } elseif ($scope === 'public') {
            $query->where('is_public', true);
        } elseif ($scope === 'private') {
            abort_unless($user?->role === 'admin', 403);
            $query->where('is_public', false);
        } elseif ($scope === 'all') {
            abort_unless($user?->role === 'admin', 403);
        } else {
            abort(422, 'Invalid character scope.');
        }

        $characters = $query->paginate(3);
        $responseCharacters = $characters->map(function ($character) {
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
        });

        if (count($characters) > 0) {
            return $this->success([
                'data' => $responseCharacters,
                'current_page' => $characters->currentPage(),
                'last_page' => $characters->lastPage()
            ]);
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
            'profession.proficiencies',
            'background',
            'background.feat',
            'proficiencies',
            'feats',
            'user'
        )

            ->find($character_id);

        $responseCharacter = [
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
            "feats" => $character->feats,
            "owner_id" => $character->user->id
        ];

        if ($user && $user->role == 'admin') {

            return $this->success($responseCharacter);

        } elseif ($user) {

            if ($character->user_id != $user->id && !$character->is_public) {
                return $this->error([], "You don't have access to this character", 403);
            }

            return $this->success($responseCharacter);

        } else {

            if ($character->is_public) {
                return $this->success($responseCharacter);
            }
            return $this->error([], "You don't have access to this character", 403);

        }
    }

    public function update(Request $request, Character $character)
    {
        $user = $request->user('sanctum');

        if (
            !in_array($user->role, ['user', 'admin'], true) ||
            ($user->role === 'user' &&
                (string) $character->user_id !== (string) $user->getAuthIdentifier())
        ) {
            return $this->error([], "You don't have access to this character", 403);
        }

        $validated = $request->validate([
            'is_public' => ['sometimes', 'boolean'],
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'level' => ['sometimes', 'integer', 'min:1', 'max:20'],
            'background_id' => ['sometimes', 'nullable', 'integer', 'exists:backgrounds,id'],
            'species_id' => ['sometimes', 'nullable', 'integer', 'exists:species,id'],
            'profession_id' => ['sometimes', 'nullable', 'integer', 'exists:professions,id'],
            'backstory' => ['sometimes', 'nullable', 'string'],
            'strength' => ['sometimes', 'integer', 'min:1', 'max:20'],
            'dexterity' => ['sometimes', 'integer', 'min:1', 'max:20'],
            'constitution' => ['sometimes', 'integer', 'min:1', 'max:20'],
            'intellect' => ['sometimes', 'integer', 'min:1', 'max:20'],
            'wisdom' => ['sometimes', 'integer', 'min:1', 'max:20'],
            'charisma' => ['sometimes', 'integer', 'min:1', 'max:20'],
            'inventory' => ['sometimes', 'string'],
            'proficiencies_present' => ['sometimes', 'accepted'],
            'proficiencies' => ['sometimes', 'array'],
            'proficiencies.*' => ['integer', 'distinct', 'exists:proficiencies,id'],
            'feats_present' => ['sometimes', 'accepted'],
            'feats' => ['sometimes', 'array'],
            'feats.*' => ['integer', 'distinct', 'exists:feats,id'],
            'image' => ['sometimes', 'image'],
        ]);

        if ($request->hasFile('image')) {
            if ($character->image) {
                Storage::delete($character->image);
            }
            $newImagePath = Storage::putFile('characters', $request->file('image'));

            $character->image = $newImagePath;
        }

        if (array_key_exists('is_public', $validated)) {
            $character->is_public = $validated['is_public'];
        }
        if (array_key_exists('name', $validated)) {
            $character->name = $validated['name'];
        }
        if (array_key_exists('level', $validated)) {
            $character->level = $validated['level'];
        }
        if (array_key_exists('background_id', $validated)) {
            $character->background_id = $validated['background_id'];
        }
        if (array_key_exists('species_id', $validated)) {
            $character->species_id = $validated['species_id'];
        }
        if (array_key_exists('profession_id', $validated)) {
            $character->profession_id = $validated['profession_id'];
        }
        if (array_key_exists('backstory', $validated)) {
            $character->backstory = $validated['backstory'];
        }
        if (array_key_exists('strength', $validated)) {
            $character->strength = $validated['strength'];
        }
        if (array_key_exists('dexterity', $validated)) {
            $character->dexterity = $validated['dexterity'];
        }
        if (array_key_exists('constitution', $validated)) {
            $character->constitution = $validated['constitution'];
        }
        if (array_key_exists('intellect', $validated)) {
            $character->intellect = $validated['intellect'];
        }
        if (array_key_exists('wisdom', $validated)) {
            $character->wisdom = $validated['wisdom'];
        }
        if (array_key_exists('charisma', $validated)) {
            $character->charisma = $validated['charisma'];
        }
        if (array_key_exists('inventory', $validated)) {
            $character->inventory = $validated['inventory'];
        }

        $character->update();

        if (array_key_exists('proficiencies_present', $validated)) {
            $character->proficiencies()->sync($validated['proficiencies'] ?? []);
        }

        if (array_key_exists('feats_present', $validated)) {
            $character->feats()->sync($validated['feats'] ?? []);
        }

        return $this->success(
            $character->load('species', 'profession', 'background', 'proficiencies', 'feats'),
            'Character updated successfully.'
        );
    }

    public function store(Request $request)
    {
        $user = $request->user('sanctum');

        if (!in_array($user->role, ['user', 'admin'], true)) {
            return $this->error([], 'You are not authorized to create characters.', 403);
        }

        $validated = $request->validate([
            'is_public' => ['sometimes', 'boolean'],
            'name' => ['required', 'string', 'max:255'],
            'level' => ['required', 'integer', 'min:1', 'max:20'],
            'background_id' => ['required', 'integer', 'exists:backgrounds,id'],
            'species_id' => ['required', 'integer', 'exists:species,id'],
            'profession_id' => ['required', 'integer', 'exists:professions,id'],
            'backstory' => ['nullable', 'string'],
            'strength' => ['required', 'integer', 'min:1', 'max:20'],
            'dexterity' => ['required', 'integer', 'min:1', 'max:20'],
            'constitution' => ['required', 'integer', 'min:1', 'max:20'],
            'intellect' => ['required', 'integer', 'min:1', 'max:20'],
            'wisdom' => ['required', 'integer', 'min:1', 'max:20'],
            'charisma' => ['required', 'integer', 'min:1', 'max:20'],
            'inventory' => ['required', 'string'],
            'proficiencies' => ['sometimes', 'array'],
            'proficiencies.*' => ['integer', 'distinct', 'exists:proficiencies,id'],
            'feats' => ['sometimes', 'array'],
            'feats.*' => ['integer', 'distinct', 'exists:feats,id'],
            'image' => ['sometimes', 'image'],
        ]);

        $character = new Character();

        $character->user_id = $user->getAuthIdentifier();
        $character->is_public = $validated['is_public'] ?? false;
        $character->name = $validated['name'];
        $character->level = $validated['level'];
        $character->background_id = $validated['background_id'];
        $character->species_id = $validated['species_id'];
        $character->profession_id = $validated['profession_id'];
        $character->backstory = $validated['backstory'];
        $character->strength = $validated['strength'];
        $character->dexterity = $validated['dexterity'];
        $character->constitution = $validated['constitution'];
        $character->intellect = $validated['intellect'];
        $character->wisdom = $validated['wisdom'];
        $character->charisma = $validated['charisma'];
        $character->inventory = $validated['inventory'];

        if ($request->hasFile('image')) {
            $img_path = Storage::putFile('characters', $request->file('image'));
            $character->image = $img_path;
        }

        $character->save();

        $character->proficiencies()->attach($validated['proficiencies'] ?? []);
        $character->feats()->attach($validated['feats'] ?? []);

        return $this->success(
            $character->load('species', 'profession', 'background', 'proficiencies', 'feats'),
            "Character created succesfully.",
            201
        );
    }
}
