<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $dataUser = [
        //     [
        //         'nama' => 'User',
        //         'email' => 'user@gmail.com',
        //         'password' => Hash::make('user@gmail.com'),
        //         'nip' => 12345,
        //         'role' => 'user'
        //     ],
        //     [
        //         'nama' => 'Admin',
        //         'email' => 'admin@gmail.com',
        //         'password' => Hash::make('admin@gmail.com'),
        //         'nip' => 51235,
        //         'role' => 'admin'
        //     ],
        //     [
        //         'nama' => 'Pokja',
        //         'email' => 'pokja@gmail.com',
        //         'password' => Hash::make('pokja@gmail.com'),
        //         'nip' => 11562,
        //         'role' => 'pokja'
        //     ]
        // ];
        // User::insert($dataUser);
    }
}
