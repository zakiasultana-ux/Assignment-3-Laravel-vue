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
            UserSeeder::class,
            AuthorSeeder::class,
            BookSeeder::class,
        ]);
    }
}
