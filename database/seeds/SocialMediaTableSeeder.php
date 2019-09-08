<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SocialMediaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('social_media')->insert([
            ['name' => 'facebook', 'tag' => 'fb'],
            ['name' => 'twitter', 'tag' => 'twitter'],
            ['name' => 'instagram', 'tag' => 'ig'],
            ['name' => 'linked-in', 'tag' => 'linked-in']
        ]);
    }
}
