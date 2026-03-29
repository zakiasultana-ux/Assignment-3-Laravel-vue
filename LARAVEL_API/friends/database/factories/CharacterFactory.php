<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CharacterFactory extends Factory
{
    /**
     * The real Friends characters and their details for static seeding.
     * We use the factory's definition for pseudo-random fallback data.
     *
     * @return array
     */
    public function definition()
    {
        $occupations = [
            'Paleontologist',
            'Chef',
            'Masseuse',
            'Actress',
            'Actor',
            'Data Analyst',
            'Art Buyer',
            'Coffee Shop Barista',
            'Fashion Buyer',
            'Advertising Executive',
            'Museum Curator',
            'Personal Shopper',
        ];

        $catchphrases = [
            'How you doin\'?',
            'Oh. My. God.',
            'Could this BE any more...?',
            'We were on a break!',
            'Smelly cat, smelly cat...',
            'I know!',
            'Pivot!',
            'Fine by me.',
            'Could I BE wearing any more clothes?',
            'JOEY DOESN\'T SHARE FOOD!',
        ];

        return [
            'name'        => $this->faker->name(),
            'actor_name'  => $this->faker->name(),
            'occupation'  => $this->faker->randomElement($occupations),
            'bio'         => $this->faker->paragraph(3),
            'catchphrase' => $this->faker->randomElement($catchphrases),
        ];
    }
}
