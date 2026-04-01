<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // BookSeeder::class === Database\Seeders\BookSeeder
        $this->call([
            CharacterSeeder::class,
            EpisodeSeeder::class,
            RelationshipSeeder::class,
        ]);
    }
}
