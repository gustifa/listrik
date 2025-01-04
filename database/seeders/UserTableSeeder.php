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
                'name' => 'instructor',
                'username' => 'instructor',
                'email' => 'instructor@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'instructor',
                'status' => '1',
                'created_at' => Carbon::now(),
            ],
            //user
            [
                'id' => '3',
                'name' => 'user',
                'username' => 'user',
                'email' => 'user@gmail.com',
                'password' => Hash::make('111'),
                'role' => 'user',
                'status' => '1',
                'created_at' => Carbon::now(),
            ],
        ]);

    }
}
