<?php

namespace App\Http\Controllers;

use App\Models\Character;
use Illuminate\Http\Request;

class CharacterController extends Controller
{
    /**
     * Return a list of characters with optional filters.
     *
     * Filters supported:
     *   ?search=        - search name, actor_name, bio, catchphrase
     *   ?occupation=    - filter by occupation (partial match)
     *   ?actor_name=    - filter by actor name (partial match)
     *
     * @param Request $request
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function index(Request $request)
    {
        $query = Character::query();

        // Filter 1: Full-text search across name, actor, bio, catchphrase
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', '%' . $search . '%')
                  ->orWhere('actor_name', 'LIKE', '%' . $search . '%')
                  ->orWhere('bio', 'LIKE', '%' . $search . '%')
                  ->orWhere('catchphrase', 'LIKE', '%' . $search . '%');
            });
        }

        // Filter 2: Filter by occupation (partial match)
        if ($request->filled('occupation')) {
            $query->where('occupation', 'LIKE', '%' . $request->get('occupation') . '%');
        }

        // Filter 3: Filter by actor name (partial match)
        if ($request->filled('actor_name')) {
            $query->where('actor_name', 'LIKE', '%' . $request->get('actor_name') . '%');
        }

        $characters = $query->withCount('episodes')->orderBy('name')->get();

        return response()->json([
            'data'  => $characters,
            'total' => $characters->count(),
        ]);
    }

    /**
     * Show a single character with their episodes.
     *
     * @param Character $character
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Character $character)
    {
        $character->load('episodes');
        return response()->json(['data' => $character]);
    }

    /**
     * Create a new character.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $character = Character::create([
            'name'        => $request->input('name'),
            'actor_name'  => $request->input('actor_name'),
            'occupation'  => $request->input('occupation'),
            'bio'         => $request->input('bio'),
            'catchphrase' => $request->input('catchphrase'),
        ]);

        return response()->json(['data' => $character], 201);
    }

    /**
     * Update an existing character.
     *
     * @param Request $request
     * @param Character $character
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Character $character)
    {
        $fields = ['name', 'actor_name', 'occupation', 'bio', 'catchphrase'];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $character->$field = $request->input($field);
            }
        }

        $character->save();

        return response()->json(['data' => $character]);
    }

    /**
     * Soft-delete a character.
     *
     * @param Character $character
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Character $character)
    {
        $character->delete();
        return response()->json(['message' => 'Character deleted successfully.']);
    }
}
