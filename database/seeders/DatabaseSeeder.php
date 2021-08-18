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
        $this->call(LaratrustSeeder::class);
        DB::table('locations')->insert([
            ['name' => 'PASTEUR, BANDUNG', 'color' => '#f56954'],
            ['name' => 'SUKAJADI, BANDUNG', 'color' => '#00a65a'],
            ['name' => 'CICENDO, BANDUNG', 'color' => '#f39c12'],
        ]);

        DB::table('categories')->insert([
            ['name' => 'PAKET NORMAL',],
            ['name' => 'PAKET MEMBERSHIP',],
            ['name' => 'PAKET PERSONAL',],
        ]);

        DB::table('services')->insert([
            [
                'category_id' => 1,
                'name' => 'FAST HAIRCUT',
                'duration' => 1,
                'time' => 'Hr',
                'price' => 40,
                'desc' => 'HAIRCUT, STYLING, HAIRTONIC/POMADE',
            ],
            [
                'category_id' => 1,
                'name' => 'BASIC HAIRCUT',
                'duration' => 20,
                'time' => 'mins',
                'price' => 50,
                'desc' => 'HAIRCUT, WASHING, MASSAGE',
            ],[
                'category_id' => 1,
                'name' => 'SIGNATURE HAIRCUT',
                'duration' => 30,
                'time' => 'mins',
                'price' => 70,
                'desc' => 'HAIRCUT, WASHING, MASSAGE',
            ],
            [
                'category_id' => 2,
                'name' => 'FATHER & SON',
                'duration' => 1,
                'time' => 'Hr',
                'price' => 80,
                'desc' => 'POTONG RAMBUT, KERAMAS, MASSAGE',
            ],
            [
                'category_id' => 2,
                'name' => 'STUDENT SERVICE',
                'duration' => 20,
                'time' => 'mins',
                'price' => 35,
                'desc' => null,
            ],[
                'category_id' => 3,
                'name' => 'CUKURAN DI RUMAH',
                'duration' => 30,
                'time' => 'mins',
                'price' => 60,
                'desc' => null,
            ],
        ]);

        DB::table('payments')->insert([
            [
                'bank' => 'BRI',
                'cabang' => 'Bandung',
                'an' => 'Boy',
                'norek' => '123456789',
            ],
            [
                'bank' => 'BNI',
                'cabang' => 'Cimahi',
                'an' => 'Bro',
                'norek' => '987654321',
            ],[
                'bank' => 'Mandiri',
                'cabang' => 'Kab. Bandung',
                'an' => 'Bam',
                'norek' => '735327357234',
            ],
        ]);
    }
}
