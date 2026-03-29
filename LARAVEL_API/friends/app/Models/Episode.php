<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Episode extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'season_number',
        'episode_number',
        'description', //describes how was the episode
        'air_year',
        'imdb_rating', //the rating of the episode
        'director',
        'featured_character_id',
    ];

    /**
     * The character that is featured in this episode.
     */
    public function featuredCharacter(): BelongsTo
    {
        return $this->belongsTo(Character::class, 'featured_character_id');
    }
}
