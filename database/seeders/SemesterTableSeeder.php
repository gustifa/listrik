<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class SemesterTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('semesters')->insert([
            [
                'nama' => 'Genap',
                'created_at' => Carbon::now(),
            ],

            [
                'nama' => 'Ganjil',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
