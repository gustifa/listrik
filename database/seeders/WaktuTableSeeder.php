<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
            [
                'nama' => 2,
                'waktu_mulai' => '07:45',
                'waktu_selesai' => '08:30',
                'created_at' => Carbon::now(),
            ],

            [
                'nama' => 3,
                'waktu_mulai' => '08:30',
                'waktu_selesai' => '09:15',
                'created_at' => Carbon::now(),
            ],
            [
                'nama' => 4,
                'waktu_mulai' => '09:15',
                'waktu_selesai' => '10:00',
                'created_at' => Carbon::now(),
            ],

            [
                'nama' => 5,
                'waktu_mulai' => '10:15',
                'waktu_selesai' => '11:00',
                'created_at' => Carbon::now(),
            ],
            [
                'nama' => 6,
                'waktu_mulai' => '11:00',
                'waktu_selesai' => '11:45',
                'created_at' => Carbon::now(),
            ],
            [
                'nama' => 7,
                'waktu_mulai' => '11:45',
                'waktu_selesai' => '12:30',
                'created_at' => Carbon::now(),
            ],

            [
                'nama' => 8,
                'waktu_mulai' => '13:15',
                'waktu_selesai' => '14:00',
                'created_at' => Carbon::now(),
            ],

            [
                'nama' => 9,
                'waktu_mulai' => '14:00',
                'waktu_selesai' => '14:45',
                'created_at' => Carbon::now(),
            ],

            [
                'nama' => 10,
                'waktu_mulai' => '14:45',
                'waktu_selesai' => '15:30',
                'created_at' => Carbon::now(),
            ],

            [
                'nama' => 11,
                'waktu_mulai' => '15:45',
                'waktu_selesai' => '16:30',
                'created_at' => Carbon::now(),
            ],

            [
                'nama' => 12,
                'waktu_mulai' => '16:30',
                'waktu_selesai' => '17:15',
                'created_at' => Carbon::now(),
            ],

            [
                'nama' => 13,
                'waktu_mulai' => '17:15',
                'waktu_selesai' => '18:00',
                'created_at' => Carbon::now(),
            ],

        ]);
    }
}
