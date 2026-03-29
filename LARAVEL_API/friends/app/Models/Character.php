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
        'name',
        'actor_name',
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
