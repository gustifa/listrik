<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TahunPelajaranTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tahun_pelajarans')->insert([
            [
                'nama' => '2024/2025',
                'created_at' => Carbon::now(),
            ],

            [
                'nama' => '2025/2026',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
