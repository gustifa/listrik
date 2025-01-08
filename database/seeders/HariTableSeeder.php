<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class HariTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('haris')->insert([
            [
                'nama_hari' => 'SENIN',
                'created_at' => Carbon::now(),
            ],

            [
                'nama_hari' => 'SELASA',
                'created_at' => Carbon::now(),
            ],

            [
                'nama_hari' => 'RABU',
                'created_at' => Carbon::now(),
            ],
            [
                'nama_hari' => 'KAMIS',
                'created_at' => Carbon::now(),
            ],

            [
                'nama_hari' => 'JUMAT',
                'created_at' => Carbon::now(),
            ],
            [
                'nama_hari' => 'SABTU',
                'created_at' => Carbon::now(),
            ],

        ]);
    }
}
