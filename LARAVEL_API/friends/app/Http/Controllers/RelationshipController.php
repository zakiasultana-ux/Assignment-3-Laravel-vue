<?php

namespace App\Http\Controllers;

use App\Models\Relationship;
use Illuminate\Http\Request;

class RelationshipController extends Controller
{
    /**
     * Return a list of relationships with optional filters.
     *
     * Filters supported:
     *   ?search=   - search character_1, character_2, or status
     *   ?status=   - filter by relationship status (partial match)
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Relationship::query();

        // Filter 1: Full-text search across character names and status
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('character_1', 'LIKE', '%' . $search . '%')
                  ->orWhere('character_2', 'LIKE', '%' . $search . '%')
                  ->orWhere('status',      'LIKE', '%' . $search . '%');
            });
        }

        // Filter 2: Filter by relationship status (partial match)
        if ($request->filled('status')) {
            $query->where('status', 'LIKE', '%' . $request->get('status') . '%');
        }

        $relationships = $query->orderBy('character_1')->get();

        return response()->json([
            'data'  => $relationships,
            'total' => $relationships->count(),
        ]);
    }

    /**
     * Show a single relationship.
     *
     * @param Relationship $relationship
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Relationship $relationship)
    {
        return response()->json(['data' => $relationship]);
    }

    /**
     * Create a new relationship.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $relationship = Relationship::create([
            'character_1' => $request->input('character_1'),
            'character_2' => $request->input('character_2'),
            'status'      => $request->input('status'),
        ]);

        return response()->json(['data' => $relationship], 201);
    }

    /**
     * Update an existing relationship.
     *
     * @param Request $request
     * @param Relationship $relationship
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Relationship $relationship)
    {
        foreach (['character_1', 'character_2', 'status'] as $field) {
            if ($request->has($field)) {
                $relationship->$field = $request->input($field);
            }
        }

        $relationship->save();

        return response()->json(['data' => $relationship]);
    }

    /**
     * Soft-delete a relationship.
     *
     * @param Relationship $relationship
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Relationship $relationship)
    {
        $relationship->delete();
        return response()->json(['message' => 'Relationship deleted successfully.']);
    }
}
