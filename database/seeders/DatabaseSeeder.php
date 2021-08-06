<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // $this->call(LaratrustSeeder::class);
        // DB::table('locations')->insert([
        //     ['name' => 'DEDAN KIMATHI, NYERI',],
        //     ['name' => 'KAMAKWA, NYERI',],
        //     ['name' => 'NYERI TOWN, NYERI',],
        // ]);

        DB::table('categories')->insert([
            ['name' => 'HAIRCUTS',],
            ['name' => 'FACIALS RETOUCH',],
            ['name' => 'PEDICURE',],
        ]);

        DB::table('services')->insert([
            [
                'category_id' => 1,
                'name' => 'Gentelmen Cut',
                'duration' => 1,
                'time' => 'Hr',
                'price' => 500,
            ],
            [
                'category_id' => 1,
                'name' => 'Colour Shading',
                'duration' => 20,
                'time' => 'mins',
                'price' => 200,
            ],[
                'category_id' => 1,
                'name' => 'Beard',
                'duration' => 30,
                'time' => 'mins',
                'price' => 400,
            ],
            [
                'category_id' => 2,
                'name' => 'Service 1',
                'duration' => 1,
                'time' => 'Hr',
                'price' => 500,
            ],
            [
                'category_id' => 2,
                'name' => 'Service 2',
                'duration' => 20,
                'time' => 'mins',
                'price' => 200,
            ],[
                'category_id' => 3,
                'name' => 'Service 3',
                'duration' => 30,
                'time' => 'mins',
                'price' => 400,
            ],
        ]);
    }
}
