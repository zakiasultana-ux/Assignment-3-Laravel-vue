<?php

namespace Database\Factories;

use App\Models\Character;
use Illuminate\Database\Eloquent\Factories\Factory;

class EpisodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $character = Character::inRandomOrder()->first();

        $directors = [
            'Kevin S. Bright',
            'James Burrows',
            'Gary Halvorson',
            'Michael Lembeck',
            'David Schwimmer',
            'Kevin S. Bright',
            'Sheldon Epps',
            'Peter Bonerz',
            'Robby Benson',
        ];

        $season  = $this->faker->numberBetween(1, 10);
        $episode = $this->faker->numberBetween(1, 24);

        return [
            'title'                => 'The One ' . $this->faker->words(3, true),
            'season_number'        => $season,
            'episode_number'       => $episode,
            'description'          => $this->faker->paragraph(2),
            'air_year'             => $this->faker->numberBetween(1994, 2004),
            'imdb_rating'          => $this->faker->randomFloat(1, 7.0, 9.7),
            'director'             => $this->faker->randomElement($directors),
            'featured_character_id' => $character ? $character->id : null,
            'image_url'            => 'https://picsum.photos/seed/friends-s' . $season . 'e' . $episode . '/400/225',
        ];
    }
}
