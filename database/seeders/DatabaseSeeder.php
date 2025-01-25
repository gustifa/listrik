<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(SekolahTableSeeder::class);
        $this->call(WaktuTableSeeder::class);
        $this->call(HariTableSeeder::class);
        $this->call(GroupTableSeeder::class);
        $this->call(KelasTableSeeder::class);
        $this->call(TahunPelajaranTableSeeder::class);
        $this->call(SemesterTableSeeder::class);
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
