<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class KelasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kelas')->insert([
            [
                'nama_kelas' => 'X',
                'created_at' => Carbon::now(),
            ],

            [
                'nama_kelas' => 'XI',
                'created_at' => Carbon::now(),
            ],
            [
                'nama_kelas' => 'XII',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
