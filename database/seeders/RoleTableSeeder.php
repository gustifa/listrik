<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::create(['name' => 'Super Admin']);
        $admin = Role::create(['name' => 'admin']);
        $wakil = Role::create(['name' => 'wakil']);
        $guru = Role::create(['name' => 'guru']);
        $siswa = Role::create(['name' => 'siswa']);

        $admin->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-pembelajaran',
            'edit-pembelajaran',
            'delete-pembelajaran',
             'view-pembelajaran'
        ]);
        $wakil->givePermissionTo([
            'create-pembelajaran',
            'edit-pembelajaran',
            'delete-pembelajaran',
            'view-pembelajaran'
            
        ]);

        $guru->givePermissionTo([
            'create-pembelajaran',
            'edit-pembelajaran',
            'delete-pembelajaran'
        ]);

        $siswa->givePermissionTo([
            'view-pembelajaran'
        ]);
    }
    
}
