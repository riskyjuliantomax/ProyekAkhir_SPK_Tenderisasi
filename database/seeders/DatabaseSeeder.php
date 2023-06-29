<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Crips;
use App\Models\Kriteria;
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
        $userId = User::insertGetId([
            'nama' => 'User2',
            'email' => 'user2@gmail.com',
            'nip' => '002012',
            'role' => 0,
            'password' => Hash::make('user2@gmail.com'),
            'created_at' => $now,
            'updated_at' => $now
        ]);
        UserAlamat::create([
            'id_users' => $userId,
        ]);

        $kriteriaId = Kriteria::insertGetId([
            'nama_kriteria' => 'Administrasi',
            'bobot' => 0.30,
            'attribut' => 'benefit',
            'created_at' => $now,
            'updated_at' => $now
        ]);

        $dataCrips = [
            [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Sangat Bagus',
                'nilai' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Bagus',
                'nilai' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Kurang',
                'nilai' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Sangat Kurang',
                'nilai' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Tidak Ada',
                'nilai' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
        Crips::insert($dataCrips);

        $kriteriaId = Kriteria::insertGetId([
            'nama_kriteria' => 'Teknis',
            'bobot' => 0.45,
            'attribut' => 'benefit',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $dataCrips = [
            [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Sangat Bagus',
                'nilai' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Bagus',
                'nilai' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Kurang',
                'nilai' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Sangat Kurang',
                'nilai' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Tidak Ada',
                'nilai' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
        Crips::insert($dataCrips);

        $kriteriaId = Kriteria::insertGetId([
            'nama_kriteria' => 'Harga',
            'bobot' => 0.25,
            'attribut' => 'benefit',
            'created_at' => $now,
            'updated_at' => $now
        ]);
        $dataCrips = [
            [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Sesuai',
                'nilai' => 5,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Lebih Rendah Dari Harga Awalan',
                'nilai' => 4,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Lebih Tinggi Dari Harga Awalan',
                'nilai' => 3,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Harga Tidak Masuk Akal',
                'nilai' => 2,
                'created_at' => $now,
                'updated_at' => $now
            ], [
                'id_kriteria' => $kriteriaId,
                'nama_crips' => 'Harga Tidak Valid',
                'nilai' => 1,
                'created_at' => $now,
                'updated_at' => $now
            ]
        ];
        Crips::insert($dataCrips);
    }
}
