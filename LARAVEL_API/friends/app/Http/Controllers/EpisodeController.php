<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Models\Episode;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    /**
     * Return a list of episodes with optional filters.
     *
     * Filters supported:
     *   ?search=              - search title and description
     *   ?season=              - filter by season number (exact)
     *   ?min_rating=          - filter by minimum IMDB rating
     *   ?featured_character_id= - filter by featured character ID
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $query = Episode::query()->with('featuredCharacter');

        // Filter 1: Text search across title and description
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                  ->orWhere('description', 'LIKE', '%' . $search . '%')
                  ->orWhere('director', 'LIKE', '%' . $search . '%');
            });
        }

        // Filter 2: Filter by season number
        if ($request->filled('season')) {
            $query->where('season_number', '=', (int) $request->get('season'));
        }

        // Filter 3: Filter by minimum IMDB rating
        if ($request->filled('min_rating')) {
            $query->where('imdb_rating', '>=', (float) $request->get('min_rating'));
        }

        // Filter 4: Filter by featured character
        if ($request->filled('featured_character_id')) {
            $query->where('featured_character_id', '=', (int) $request->get('featured_character_id'));
        }

        // Sort: by season and episode number by default
        $query->orderBy('season_number')->orderBy('episode_number');

        $episodes = $query->get();

        return response()->json([
            'data'  => $episodes,
            'total' => $episodes->count(),
        ]);
    }

    /**
     * Show a single episode with its featured character.
     *
     * @param Episode $episode
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Episode $episode)
    {
        $episode->load('featuredCharacter');
        return response()->json(['data' => $episode]);
    }

    /**
     * Create a new episode.
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $episode = Episode::create([
            'title'                  => $request->input('title'),
            'season_number'          => $request->input('season_number'),
            'episode_number'         => $request->input('episode_number'),
            'description'            => $request->input('description'),
            'air_year'               => $request->input('air_year'),
            'imdb_rating'            => $request->input('imdb_rating'),
            'director'               => $request->input('director'),
            'featured_character_id'  => $request->input('featured_character_id'),
            'image_url'              => $request->input('image_url'),
        ]);

        $episode->load('featuredCharacter');

        return response()->json(['data' => $episode], 201);
    }

    /**
     * Update an existing episode.
     *
     * @param Request $request
     * @param Episode $episode
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Episode $episode)
    {
        $fields = [
            'title',
            'season_number',
            'episode_number',
            'description',
            'air_year',
            'imdb_rating',
            'director',
            'featured_character_id',
            'image_url',
        ];

        foreach ($fields as $field) {
            if ($request->has($field)) {
                $episode->$field = $request->input($field);
            }
        }

        $episode->save();
        $episode->load('featuredCharacter');

        return response()->json(['data' => $episode]);
    }

    /**
     * Soft-delete an episode.
     *
     * @param Episode $episode
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Episode $episode)
    {
        $episode->delete();
        return response()->json(['message' => 'Episode deleted successfully.']);
    }
}
