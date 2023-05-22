<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        //     DB::table('users')->insert([
        //         'nama' => Str::random(10),
        //         'email' => Str::random(10).'@gmail.com',
        //         'no_hp' => rand(000000000000,999999999999),
        //         'tentang'=>  Str::random(20),
        //         'tgl_lahir'=> Date('2001-01-13'),
        //         'kelamin'=>'laki-laki',
        //         'tempat_lahir'=> Str::random(),
        //         'img_profile'=> Str::random(),
        //         'password'=> bcrypt('secret'),
        //     ]
        // );
        DB::table('kriteria_cost')->insert(
            [
                'nama' => 'Biaya Perawatan',
            ],
            [
                'nama' => 'Biaya Operasional',
            ],
            [
                'nama' => 'Biaya Kerusakan',
            ]
        );
    }
}
