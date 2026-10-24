<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Profession;
use App\Models\Spell;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;

class SpellController extends Controller
{
    use HttpResponses;
    public function index(Request $request)
    {
        $search = $request->query('search');
        $classes = array_filter(array_map('trim', explode(',', $request->query('classes', 'any'))));
        $query = Spell::with('professions');

        if ($search) {
            $query->where('name', 'LIKE', "%$search%");
        }
        $mapSpells = function ($spell) {
            return [
                'id' => $spell->id,
                'name' => $spell->name,
                'description' => $spell->description,
                'level' => $spell->level,
                'casting_time' => $spell->casting_time,
                'range' => $spell->range,
                'components' => $spell->components,
                'duration' => $spell->duration,
                'profession' => $spell->profession,
            ];
        };

        if ($classes && !in_array('any', $classes, true)) {
            $query->whereHas('professions', function ($professionQuery) use ($classes) {
                $professionQuery->whereIn('name', $classes);
            });
        }

        if (!$request->boolean('paginate', false)) {
            return $this->success([
                'data' => $query->get()->orderBy('level')->map($mapSpells),
            ]);
        }

        $features = $query->orderBy('level')->paginate(21);
        $features->through($mapSpells);
        return $this->success([
            'data' => $features->items(),
            'current_page' => $features->currentPage(),
            'last_page' => $features->lastPage()
        ]);
    }

    public function show(Request $request){
        $spell_id = $request->spell;
        $spell = Spell::with('professions')->findOrFail($spell_id);

        return $this->success($spell);
    }
}
