<?php

use Illuminate\Database\Seeder;
use App\post;

class postsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        post::create([
            'id' => 2,
            'title'=> 'Added 7 ICU beds',
            'body' => 'Muranga Level 5 hospital has taken initiative by the gorvernment and added five more ICU facilities in the department',
            'cover_image' => 'hskjshr'
        ]);
        post::create([
            'id' => 3,
            'title'=> 'Feed a child Launch',
            'body' => 'Joseph Ndirangu, Muranga level 5 CEO, has officially launched the feed a child program which aims to reach at least 1000 homeless children on the streets and provide a meal',
            'cover_image' => 'fdglksdf'
        ]);

    }
}
