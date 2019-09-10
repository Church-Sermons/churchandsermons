<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PrivacyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('privacy')->insert([
            ['name' => 'public'],
            ['name' => 'private']
        ]);
    }
}
