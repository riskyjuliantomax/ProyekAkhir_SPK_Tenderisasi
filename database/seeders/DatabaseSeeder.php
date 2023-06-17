<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\KriteriaCost;
use App\Models\User;
use App\Models\UserAlamat;
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
        $dataKriteriaCost = [
            [
                'nama' => 'Biaya Perawatan',
            ],
            [
                'nama' => 'Biaya Operasional',
            ],
            [
                'nama' => 'Biaya Kerusakan',
            ]
        ];

        KriteriaCost::insert($dataKriteriaCost);
        $now =  \Carbon\Carbon::now()->toDateTimeString();
        $userId = User::insertGetId([
            'nama' => 'Admin',
            'email' => 'admin@gmail.com',
            'nip' => '00000',
            'role' => 2,
            'password' => Hash::make('admin@gmail.com'),
            'created_at' => $now,
            'updated_at' => $now
        ]);
        UserAlamat::create([
            'id_users' => $userId,
        ]);
        $userId = User::insertGetId([
            'nama' => 'Pokja',
            'email' => 'pokja@gmail.com',
            'nip' => '000001',
            'role' => 1,
            'password' => Hash::make('pokja@gmail.com'),
            'created_at' => $now,
            'updated_at' => $now
        ]);
        UserAlamat::create([
            'id_users' => $userId,
        ]);
        $userId = User::insertGetId([
            'nama' => 'User',
            'email' => 'user@gmail.com',
            'nip' => '000012',
            'role' => 0,
            'password' => Hash::make('user@gmail.com'),
            'created_at' => $now,
            'updated_at' => $now
        ]);
        UserAlamat::create([
            'id_users' => $userId,
        ]);
    }
}
