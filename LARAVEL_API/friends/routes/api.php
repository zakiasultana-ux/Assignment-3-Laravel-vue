<?php

use App\Http\Controllers\CharacterController;
use App\Http\Controllers\EpisodeController;
use App\Http\Controllers\RelationshipController;
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
            'characters'    => url('/api/characters'),
            'episodes'      => url('/api/episodes'),
            'relationships' => url('/api/relationships'),
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

// -----------------------------------------------------------------------
// Relationships resource
// GET    /api/relationships                    list all relationships
// POST   /api/relationships                    create
// GET    /api/relationships/{relationship}     single
// PATCH  /api/relationships/{relationship}     partial update
// DELETE /api/relationships/{relationship}     soft delete
// -----------------------------------------------------------------------
Route::get('/relationships',                    [RelationshipController::class, 'index']);
Route::post('/relationships',                   [RelationshipController::class, 'store']);
Route::get('/relationships/{relationship}',     [RelationshipController::class, 'show']);
Route::patch('/relationships/{relationship}',   [RelationshipController::class, 'update']);
Route::delete('/relationships/{relationship}',  [RelationshipController::class, 'destroy']);
