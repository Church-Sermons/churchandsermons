<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class SiteDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = DB::table('site_details')->count();

        if ($count < 1) {
            DB::table('site_details')->insert([
                [
                    'description' =>
                        'Architecto provident tempora nostrum molestias. Possimus voluptatem nam veritatis impedit ratione quam quibusdam quia. In nobis harum deleniti quia voluptas atque. Quo soluta qui sed ratione excepturi. Quasi quia delectus nulla veritatis sed ducimus excepturi facere. Mollitia deserunt adipisci deleniti accusamus rerum est ratione eum',
                    'mission' =>
                        'Quae non reprehenderit consequatur autem. Voluptas molestiae quisquam quia minima eaque. Non fugiat omnis voluptates occaecati. Nesciunt repudiandae error quod. Hic eaque et aut exercitationem laborum commodi non rem. Unde et quo et dolorem modi. Odit labore enim nihil expedita',
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            ]);
        }
    }
}
