<?php

use App\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = [
            'Vegano',
            'Vegetariano',
            'Carne',
            'Pesce',
            'Senza Lattosio',
        ];

        foreach($tags as $tag){

            $newTag = new Tag();
            $newTag->name = $tag;
            $newTag->save();

        }
    }
}
