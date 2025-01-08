<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('groups')->insert([
            [
                'nama_group' => '1',
                'created_at' => Carbon::now(),
            ],

            [
                'nama_group' => '2',
                'created_at' => Carbon::now(),
            ],
        ]);
    }
}
