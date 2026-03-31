<?php

namespace Database\Seeders;

use App\Models\Character;
use Illuminate\Database\Seeder;

class CharacterSeeder extends Seeder
{
    /**
     * Seed the characters table with the main Friends cast,
     * then use the factory to add additional characters.
     *
     * @return void
     */
    public function run()
    {
        // Static data for the 6 main Friends characters
        $mainCharacters = [
            [
                'name'        => 'Rachel Green',
                'actor_name'  => 'Jennifer Aniston',
                'occupation'  => 'Fashion Executive at Ralph Lauren',
                'bio'         => 'Rachel Karen Green is a fashion-savvy, spoiled but lovable daughter of a wealthy doctor. She runs away from her wedding to Barry Farber and moves in with her high school friend Monica Geller. Over the series she transforms from a pampered princess into an independent career woman, rising through the fashion industry. She shares a complex, on-again off-again romance with Ross Geller throughout the ten seasons.',
                'catchphrase' => 'Oh my God!',
                'image_url'   => 'https://static.wikia.nocookie.net/friends/images/a/a8/RachelGreenS10.png',
            ],
            [
                'name'        => 'Monica Geller',
                'actor_name'  => 'Courteney Cox',
                'occupation'  => 'Head Chef at Javu',
                'bio'         => 'Monica E. Geller is a competitive, perfectionist chef who serves as the primary host of the friend group. Formerly overweight in her teen years, she is now a disciplined, high-achieving professional. She is the sister of Ross Geller and eventually falls in love with and marries Chandler Bing. Known for her fierce competitiveness and obsessive cleanliness, she is also immensely warm and nurturing.',
                'catchphrase' => 'I KNOW!',
                'image_url'   => 'https://static.wikia.nocookie.net/friends/images/5/58/Monica_Geller.png',
            ],
            [
                'name'        => 'Phoebe Buffay',
                'actor_name'  => 'Lisa Kudrow',
                'occupation'  => 'Masseuse & Musician',
                'bio'         => 'Phoebe Buffay is a free-spirited masseuse and singer-songwriter who had a troubled childhood but maintains an eternal optimism about life. She is the most eccentric of the group, believes in psychics, spirits, and the paranormal. Her signature song is "Smelly Cat." She eventually finds her biological family, and marries Mike Hannigan in the final seasons.',
                'catchphrase' => 'Oh my stars!',
                'image_url'   => 'https://static.wikia.nocookie.net/friends/images/1/16/Phoebe_Buffay.png',
            ],
            [
                'name'        => 'Joey Tribbiani',
                'actor_name'  => 'Matt LeBlanc',
                'occupation'  => 'Actor (Dr. Drake Ramoray on Days of Our Lives)',
                'bio'         => 'Joseph Francis Tribbiani Jr. is a lovable, good-natured Italian-American actor who is often dim-witted but deeply loyal and kind-hearted. He is passionate about food, women, and his acting career. Though not always the sharpest tool in the shed, he has a huge heart and is fiercely protective of his friends. His most famous role is as neurosurgeon Dr. Drake Ramoray on the soap opera Days of Our Lives.',
                'catchphrase' => 'How you doin\'?',
                'image_url'   => 'https://static.wikia.nocookie.net/friends/images/b/b5/JoeyTribbiani.png',
            ],
            [
                'name'        => 'Chandler Bing',
                'actor_name'  => 'Matthew Perry',
                'occupation'  => 'Statistical Analysis and Data Reconfiguration (later Advertising Copywriter)',
                'bio'         => 'Chandler Muriel Bing is the sarcastic, self-deprecating, and humorous member of the group who uses jokes as a defense mechanism. He has a troubled childhood stemming from his parents\' divorce and his father\'s cross-dressing. He is best friends and roommate with Joey Tribbiani, and eventually falls deeply in love with and marries Monica Geller, with whom he adopts twins.',
                'catchphrase' => 'Could this BE any more awkward?',
                'image_url'   => 'https://static.wikia.nocookie.net/friends/images/6/69/ChandlerBing.png',
            ],
            [
                'name'        => 'Ross Geller',
                'actor_name'  => 'David Schwimmer',
                'occupation'  => 'Paleontologist & Professor at NYU',
                'bio'         => 'Ross Eustace Geller is a highly intelligent but socially awkward paleontologist and college professor. He is Monica\'s older brother and has been in love with Rachel Green since high school. His romantic life is a series of unfortunate events including three divorces and the famous "We were on a break" dispute. He is passionate about dinosaurs and often bores his friends with dinosaur facts.',
                'catchphrase' => 'We were on a break!',
                'image_url'   => 'https://static.wikia.nocookie.net/friends/images/5/51/RossGeller.png',
            ],
        ];

        foreach ($mainCharacters as $char) {
            Character::create($char);
        }

        // Use the factory to generate additional recurring / minor characters
        Character::factory()->count(10)->create();
    }
}
