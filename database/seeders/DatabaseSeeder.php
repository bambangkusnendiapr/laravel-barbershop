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

        DB::table('times')->insert([
            ['jam' => '09.00'],
            ['jam' => '09.30'],
            ['jam' => '10.00'],
            ['jam' => '10.30'],
            ['jam' => '11.00'],
            ['jam' => '11.30'],
            ['jam' => '12.00'],
            ['jam' => '12.30'],
            ['jam' => '13.00'],
            ['jam' => '13.30'],
            ['jam' => '14.00'],
            ['jam' => '14.30'],
            ['jam' => '15.00'],
            ['jam' => '15.30'],
            ['jam' => '16.00'],
            ['jam' => '16.30'],
            ['jam' => '17.00'],
            ['jam' => '17.30'],
            ['jam' => '18.00'],
            ['jam' => '18.30'],
            ['jam' => '19.00'],
            ['jam' => '19.30'],
            ['jam' => '20.00'],
            ['jam' => '20.30'],
            ['jam' => '21.00'],
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
                'duration' => 30,
                'price' => 40,
                'desc' => 'HAIRCUT, STYLING, HAIRTONIC/POMADE',
            ],
            [
                'category_id' => 1,
                'name' => 'BASIC HAIRCUT',
                'duration' => 30,
                'price' => 50,
                'desc' => 'HAIRCUT, WASHING, MASSAGE',
            ],[
                'category_id' => 1,
                'name' => 'SIGNATURE HAIRCUT',
                'duration' => 30,
                'price' => 70,
                'desc' => 'HAIRCUT, WASHING, MASSAGE',
            ],
            [
                'category_id' => 2,
                'name' => 'FATHER & SON',
                'duration' => 30,
                'price' => 80,
                'desc' => 'POTONG RAMBUT, KERAMAS, MASSAGE',
            ],
            [
                'category_id' => 2,
                'name' => 'STUDENT SERVICE',
                'duration' => 30,
                'price' => 35,
                'desc' => null,
            ],[
                'category_id' => 3,
                'name' => 'CUKURAN DI RUMAH',
                'duration' => 30,
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
