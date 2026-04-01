<?php

namespace Database\Seeders;

use App\Models\Relationship;
use Illuminate\Database\Seeder;

class RelationshipSeeder extends Seeder
{
    /**
     * Seed the relationships table with the key Friends character relationships.
     *
     * @return void
     */
    public function run()
    {
        $relationships = [
            ['character_1' => 'Ross Geller',     'character_2' => 'Rachel Green',   'status' => 'Romantic'],
            ['character_1' => 'Monica Geller',   'character_2' => 'Chandler Bing',  'status' => 'Married'],
            ['character_1' => 'Phoebe Buffay',   'character_2' => 'Mike Hannigan',  'status' => 'Married'],
            ['character_1' => 'Joey Tribbiani',  'character_2' => 'Chandler Bing',  'status' => 'Best Friends'],
            ['character_1' => 'Ross Geller',     'character_2' => 'Monica Geller',  'status' => 'Siblings'],
            ['character_1' => 'Rachel Green',    'character_2' => 'Monica Geller',  'status' => 'Best Friends'],
            ['character_1' => 'Rachel Green',    'character_2' => 'Phoebe Buffay',  'status' => 'Close Friends'],
            ['character_1' => 'Joey Tribbiani',  'character_2' => 'Ross Geller',    'status' => 'Close Friends'],
            ['character_1' => 'Chandler Bing',   'character_2' => 'Monica Geller',  'status' => 'Married'],
            ['character_1' => 'Phoebe Buffay',   'character_2' => 'Monica Geller',  'status' => 'Close Friends'],
        ];

        foreach ($relationships as $rel) {
            Relationship::create($rel);
        }
    }
}
