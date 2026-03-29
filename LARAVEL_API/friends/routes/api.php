http://localhost:8000/api/characters<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Friends TV Series API Routes
|--------------------------------------------------------------------------
|
| Open / publicly available API — no authentication required.
| All routes follow REST conventions.
|
*/

// Root
Route::get('/', function () {
    return response()->json([
        'api'         => 'Friends TV Series API',
        'version'     => '1.0.0',
        'description' => 'A RESTful API for browsing characters and episodes from the Friends TV series.',
        'resources'   => [
            'characters' => url('/api/characters'),
            'episodes'   => url('/api/episodes'),
        ],
    ]);
});

// -----------------------------------------------------------------------
// Characters resource
// GET    /api/characters               list, search & filter
// POST   /api/characters               create
// GET    /api/characters/{character}   single
// PATCH  /api/characters/{character}   partial update
// DELETE /api/characters/{character}   soft delete
// -----------------------------------------------------------------------
Route::get('/characters',               [CharacterController::class, 'index']);
Route::post('/characters',              [CharacterController::class, 'store']);
Route::get('/characters/{character}',   [CharacterController::class, 'show']);
Route::patch('/characters/{character}', [CharacterController::class, 'update']);
Route::delete('/characters/{character}',[CharacterController::class, 'destroy']);

// -----------------------------------------------------------------------
// Episodes resource
// GET    /api/episodes                 list, search & filter
// POST   /api/episodes                 create
// GET    /api/episodes/{episode}       single
// PATCH  /api/episodes/{episode}       partial update
// DELETE /api/episodes/{episode}       soft delete
// -----------------------------------------------------------------------
Route::get('/episodes',             [EpisodeController::class, 'index']);
Route::post('/episodes',            [EpisodeController::class, 'store']);
Route::get('/episodes/{episode}',   [EpisodeController::class, 'show']);
Route::patch('/episodes/{episode}', [EpisodeController::class, 'update']);
Route::delete('/episodes/{episode}',[EpisodeController::class, 'destroy']);
