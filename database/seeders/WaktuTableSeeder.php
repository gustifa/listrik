<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
use App\Traits\Uuid;
use Illuminate\Support\Str;

class WaktuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('waktus')->insert([
            [
                'nama' => 1,
                'waktu_mulai' => '07:00',
                'waktu_selesai' => '07:45',

                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
