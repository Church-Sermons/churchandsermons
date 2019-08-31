<?php

use Illuminate\Database\Seeder;
use App\ResourceType;

class ResourceTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ResourceType::create([
            'name' => 'video',

        ]);

        ResourceType::create([
            'name' => 'audio',
        ]);

        ResourceType::create([
            'name' => 'document'
        ]);

    }
}
