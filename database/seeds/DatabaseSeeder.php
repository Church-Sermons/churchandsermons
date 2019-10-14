<?php

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
        // $this->call(UsersTableSeeder::class);
        $this->call(LaratrustSeeder::class);
        $this->call(SocialMediaTableSeeder::class);
        $this->call(PrivacyTableSeeder::class);
        $this->call(SiteDetailsTableSeeder::class);
        // $this->call(CountriesTableSeeder::class);
    }
}
