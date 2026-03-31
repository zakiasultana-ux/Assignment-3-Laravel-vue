<?php

namespace Database\Seeders;

use App\Models\Character;
use App\Models\Episode;
use Illuminate\Database\Seeder;

class EpisodeSeeder extends Seeder
{
    /**
     * Seed the episodes table with iconic Friends episodes,
     * then use the factory to generate additional episodes.
     *
     * @return void
     */
    public function run()
    {
        // Find character IDs by name for FK references
        $rachel   = Character::where('name', 'Rachel Green')->first();
        $monica   = Character::where('name', 'Monica Geller')->first();
        $phoebe   = Character::where('name', 'Phoebe Buffay')->first();
        $joey     = Character::where('name', 'Joey Tribbiani')->first();
        $chandler = Character::where('name', 'Chandler Bing')->first();
        $ross     = Character::where('name', 'Ross Geller')->first();

        $iconicEpisodes = [
            [
                'title'                 => 'The One Where Monica Gets a Roommate (Pilot)',
                'season_number'         => 1,
                'episode_number'        => 1,
                'description'           => 'The group welcomes Rachel Green, a runaway bride who fled her own wedding, into Monica\'s apartment. She cuts up her credit cards and decides to make it on her own in New York City.',
                'air_year'              => 1994,
                'imdb_rating'           => 8.3,
                'director'              => 'James Burrows',
                'featured_character_id' => $rachel ? $rachel->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BNDVkYjU0MzctMWRmZi00NTkxLTgwZWEtOWVhYjZlYjllYmU4XkEyXkFqcGdeQXVyNTA4NzY1MzY@._V1_.jpg',
            ],
            [
                'title'                 => 'The One with the Blackout',
                'season_number'         => 1,
                'episode_number'        => 7,
                'description'           => 'A city-wide blackout traps Chandler in an ATM vestibule with a Victoria\'s Secret model. Meanwhile, the rest of the group hangs out on Monica\'s terrace and Ross almost confesses his feelings for Rachel.',
                'air_year'              => 1994,
                'imdb_rating'           => 8.6,
                'director'              => 'James Burrows',
                'featured_character_id' => $chandler ? $chandler->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BZDEyMjQ0OTctZGE2MC00ZWY5LThlMGYtMzg4NjgyYjc3OGFlXkEyXkFqcGdeQXVyNjcwMzEzMTU@._V1_.jpg',
            ],
            [
                'title'                 => 'The One with the Prom Video',
                'season_number'         => 2,
                'episode_number'        => 14,
                'description'           => 'Monica and Ross\'s parents bring over an old prom video that reveals Ross was about to stand in for Rachel\'s date when it looked like he wasn\'t going to show. Rachel finally gives Ross a chance and they kiss.',
                'air_year'              => 1996,
                'imdb_rating'           => 9.4,
                'director'              => 'James Burrows',
                'featured_character_id' => $ross ? $ross->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BOTUxMzU3MjgtNTlhMy00ZDdlLThiMTYtMzA0MmJhYTY0ZTQ1XkEyXkFqcGdeQXVyNjcwMzEzMTU@._V1_.jpg',
            ],
            [
                'title'                 => 'The One Where No One\'s Ready',
                'season_number'         => 3,
                'episode_number'        => 2,
                'description'           => 'Ross is desperate to get everyone to his museum event on time. Joey and Chandler fight over a chair, and Monica obsesses over a message she left on Richard\'s answering machine.',
                'air_year'              => 1996,
                'imdb_rating'           => 9.4,
                'director'              => 'Gail Mancuso',
                'featured_character_id' => $ross ? $ross->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BOTRhOWQ0NWUtODVmMi00ZmM2LTg1OTItMGRjYTc3ZDdiMjdiXkEyXkFqcGdeQXVyNjcwMzEzMTU@._V1_.jpg',
            ],
            [
                'title'                 => 'The One with the Morning After',
                'season_number'         => 3,
                'episode_number'        => 16,
                'description'           => 'Ross and Rachel break up after Ross sleeps with Chloe the copy store girl. This episode features the iconic "We were on a break!" argument that defines the rest of the series.',
                'air_year'              => 1997,
                'imdb_rating'           => 9.3,
                'director'              => 'James Burrows',
                'featured_character_id' => $ross ? $ross->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BMjE3MDQ1NDg0OF5BMl5BanBnXkFtZTgwMjY4MjQxMjE@._V1_.jpg',
            ],
            [
                'title'                 => 'The One with the Embryos',
                'season_number'         => 4,
                'episode_number'        => 12,
                'description'           => 'In a bet on who knows the other couple better, Monica and Rachel lose their apartment to Joey and Chandler. Meanwhile, Phoebe is successfully implanted with embryos from her brother Frank Jr. and his wife Alice.',
                'air_year'              => 1998,
                'imdb_rating'           => 9.7,
                'director'              => 'Kevin S. Bright',
                'featured_character_id' => $phoebe ? $phoebe->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BNTA1NjI3NjktOWIzMi00MDg3LWJlOWItMTFhYmIxMjliMTdmXkEyXkFqcGdeQXVyNjcwMzEzMTU@._V1_.jpg',
            ],
            [
                'title'                 => 'The One Where Ross Finds Out',
                'season_number'         => 2,
                'episode_number'        => 7,
                'description'           => 'Rachel drunkenly leaves a message on Ross\'s answering machine telling him she is over him, which leads to a dramatic confrontation and their first kiss.',
                'air_year'              => 1995,
                'imdb_rating'           => 9.1,
                'director'              => 'Peter Bonerz',
                'featured_character_id' => $rachel ? $rachel->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BNmRlZDQ4MzAtNjIwMy00NDQ0LTgxNjAtMDkwZDhhOWI5YjhhXkEyXkFqcGdeQXVyNjcwMzEzMTU@._V1_.jpg',
            ],
            [
                'title'                 => 'The One Where Everybody Finds Out',
                'season_number'         => 5,
                'episode_number'        => 14,
                'description'           => 'Phoebe discovers that Chandler and Monica are a couple, leading to a hilarious battle of wills where everyone except Ross knows. Phoebe and Chandler attempt to seduce each other to force a confession.',
                'air_year'              => 1999,
                'imdb_rating'           => 9.7,
                'director'              => 'Michael Lembeck',
                'featured_character_id' => $chandler ? $chandler->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BMjA1ODM2NDkzNl5BMl5BanBnXkFtZTgwMzY4MjQxMjE@._V1_.jpg',
            ],
            [
                'title'                 => 'The One Where Ross Got High',
                'season_number'         => 6,
                'episode_number'        => 9,
                'description'           => 'A Thanksgiving episode where Ross and Monica\'s parents visit. Rachel makes a trifle but accidentally uses a beef recipe. Joey and Ross\'s mutual secrets are finally revealed by the siblings.',
                'air_year'              => 1999,
                'imdb_rating'           => 9.3,
                'director'              => 'Gary Halvorson',
                'featured_character_id' => $rachel ? $rachel->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BMjEzMDMxNjQ5NF5BMl5BanBnXkFtZTgwNjY4MjQxMjE@._V1_.jpg',
            ],
            [
                'title'                 => 'The One with the Cop',
                'season_number'         => 5,
                'episode_number'        => 16,
                'description'           => 'Ross buys a new sofa and enlists Rachel and Chandler to help him move it up the stairs. This gives birth to the iconic "PIVOT!" meme.',
                'air_year'              => 1999,
                'imdb_rating'           => 8.8,
                'director'              => 'Andrew Tsao',
                'featured_character_id' => $ross ? $ross->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BMjMwNjYzODQxOF5BMl5BanBnXkFtZTgwNzY4MjQxMjE@._V1_.jpg',
            ],
            [
                'title'                 => 'The One with Chandler in a Box',
                'season_number'         => 4,
                'episode_number'        => 8,
                'description'           => 'Chandler must spend Thanksgiving in a wooden box as punishment for kissing Joey\'s girlfriend Kathy. Monica gets something in her eye and needs treatment from Richard\'s son.',
                'air_year'              => 1997,
                'imdb_rating'           => 9.0,
                'director'              => 'Peter Bonerz',
                'featured_character_id' => $chandler ? $chandler->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BN2I4NTkxNGYtYzg5Yi00YzE4LTllMzItNmQ3ZWE2MDIxOWM4XkEyXkFqcGdeQXVyNjcwMzEzMTU@._V1_.jpg',
            ],
            [
                'title'                 => 'The Last One (Part 1 & 2)',
                'season_number'         => 10,
                'episode_number'        => 17,
                'description'           => 'In the two-part series finale, Monica and Chandler prepare to move to the suburbs, Phoebe and Ross race to the airport to stop Rachel from moving to Paris, and Ross tells Rachel he loves her.',
                'air_year'              => 2004,
                'imdb_rating'           => 9.7,
                'director'              => 'Kevin S. Bright',
                'featured_character_id' => $rachel ? $rachel->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BMTM1MTg5MDMxMF5BMl5BanBnXkFtZTcwMjgyNTAzMQ@@._V1_.jpg',
            ],
            [
                'title'                 => 'The One with Joey\'s New Girlfriend',
                'season_number'         => 4,
                'episode_number'        => 5,
                'description'           => 'Joey starts dating Kathy, whom Chandler has feelings for. Meanwhile, Phoebe gets a cold and discovers her congested singing voice attracts better tips.',
                'air_year'              => 1997,
                'imdb_rating'           => 8.5,
                'director'              => 'Gary Halvorson',
                'featured_character_id' => $joey ? $joey->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BYzE3ZmNlZTctMTQ0OC00ZjlkLTliNDYtNzFkNzBjMTc3MjE1XkEyXkFqcGdeQXVyNjcwMzEzMTU@._V1_.jpg',
            ],
            [
                'title'                 => 'The One with Unagi',
                'season_number'         => 6,
                'episode_number'        => 17,
                'description'           => 'Ross tries to teach Rachel and Phoebe about "unagi," a state of total awareness, while they take a self-defense class and scare him. Chandler and Monica struggle to make each other valentine gifts.',
                'air_year'              => 2000,
                'imdb_rating'           => 8.8,
                'director'              => 'Gary Halvorson',
                'featured_character_id' => $ross ? $ross->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BNjQzNDI2NTU4Ml5BMl5BanBnXkFtZTgwODY4MjQxMjE@._V1_.jpg',
            ],
            [
                'title'                 => 'The One with Monica\'s Thunder',
                'season_number'         => 7,
                'episode_number'        => 1,
                'description'           => 'On Monica and Chandler\'s engagement night, Rachel kisses Ross and steals Monica\'s thunder. Phoebe and Joey get drunk at the party, and Joey auditions to be the \"minister\" for the wedding.',
                'air_year'              => 2000,
                'imdb_rating'           => 8.7,
                'director'              => 'Kevin S. Bright',
                'featured_character_id' => $monica ? $monica->id : null,
                'image_url'             => 'https://m.media-amazon.com/images/M/MV5BODc5MjYyNjgtYTM5MC00ZDgxLTk5YzgtYjAwMmM4ZGQxMDYxXkEyXkFqcGdeQXVyNjcwMzEzMTU@._V1_.jpg',
            ],
        ];

        foreach ($iconicEpisodes as $ep) {
            Episode::create($ep);
        }

        // Use factory to generate additional episodes to flesh out all 10 seasons
        Episode::factory()->count(50)->create();
    }
}
