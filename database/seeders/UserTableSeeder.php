<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use DB;
use Carbon\Carbon;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
            DB::table('users')->insert([
                //admin
            [
                'id' => '1',
                'name' => 'admin',
                'username' => 'admin',
                'email' => 'admin@gmail.com', // 'password' => rand(123456, 999999),
                'password' => Hash::make('111'),
                'role' => 'admin',
                'status' => '1',
                'created_at' => Carbon::now(),
            ],
            // instructor
            [
                'id' => '2',
                'name' => 'wakil',
                'username' => 'wakil',
                'email' => 'wakil@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'wakil',
                'status' => '1',
                'created_at' => Carbon::now(),
            ],
            //Guru
            [
                'id' => '3',
                'name' => 'guru',
                'username' => 'guru',
                'email' => 'guru@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'guru',
                'status' => '1',
                'created_at' => Carbon::now(),
            ],

            //user
            [
                'id' => '4',
                'name' => 'siswa',
                'username' => 'siswa',
                'email' => 'siswa@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'siswa',
                'status' => '1',
                'created_at' => Carbon::now(),
            ],
        ]);

    }
}
