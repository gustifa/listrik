<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
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
        */

        // Creating Super Admin User
        $superAdmin = User::create([
            'id' => Str::uuid(),
            'name' => 'Gustifa Fauzan', 
            'email' => 'fauzangustifa@gmail.com',
            'password' => Hash::make('111'),
            'jenis_user' => 'admin'
        ]);
        $superAdmin->assignRole('admin');

        // Creating Admin User
        $admin = User::create([
            'id' => Str::uuid(),
            'name' => 'Syed Ahsan Kamal', 
            'email' => 'admin@gmail.com',
            'password' => Hash::make('111'),
            'jenis_user' => 'admin'
        ]);
        $admin->assignRole('admin');

        // Creating Product Manager User
        $wakil = User::create([
            'id' => Str::uuid(),
            'name' => 'Abdul Muqeet', 
            'email' => 'wakil@gmail.com',
            'password' => Hash::make('111'),
            'jenis_user' => 'wakil'
        ]);
       $wakil->assignRole('wakil');

        // Creating Application User
        $guru = User::create([
            'id' => Str::uuid(),
            'name' => 'Naghman Ali', 
            'email' => 'guru@gmail.com',
            'password' => Hash::make('111'),
            'jenis_user' => 'guru'
        ]);
        $guru->assignRole('guru');

        // Creating Application User
        $siswa = User::create([
            'id' => Str::uuid(),
            'name' => 'Muhammad Alfatih Riski', 
            'email' => 'user@gmail.com',
            'password' => Hash::make('111'),
            'jenis_user' => 'siswa'
        ]);
       $siswa->assignRole('siswa');
    }
}
