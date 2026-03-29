<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Character extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name', //here is the name of the character in the show
        'actor_name', //here we have the real name of the person
        'occupation',
        'bio',
        'catchphrase',
    ];

    /**
     * A character can be the featured character in many episodes.
     */
    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class, 'featured_character_id');
    }
}
