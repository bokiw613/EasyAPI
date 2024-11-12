<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User; // Pastikan untuk mengimpor model User

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {

        // Buat izin 
        $permissions = [
            'roles.index',
            'roles.create',
            'roles.store',
            'roles.show',
            'roles.edit',
            'roles.update',
            'roles.destroy',
            'permissions.index',
            'permissions.create',
            'permissions.store',
            'permissions.show',
            'permissions.edit',
            'permissions.update',
            'permissions.destroy',
            'users.index',
            'users.create',
            'users.store',
            'users.show',
            'users.edit',
            'users.update',
            'users.destroy',
            'data.index',
            'data.view',
            'data.show', 
            'data.store',     
            'data.create',    
            'data.edit',     
            'data.delete',   
        ];

        // Membuat izin 
        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name'=> $permission]);
        }

        // Membuat peran admin dan memberikan semua izin
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $adminRole->syncPermissions($permissions);

        // Membuat peran user dan memberikan izin tertentu
        $userPermissions = [
            'data.view',     
            'data.show',     
            'data.edit',     
        ];

        $userRole = Role::firstOrCreate(['name' => 'user']);
        $userRole->syncPermissions($userPermissions);

        // Tambahkan pengguna admin
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name' => 'Admin',
                'password' => bcrypt('citarum01') // Ganti dengan password yang aman
            ]
        );
        $adminUser->assignRole($adminRole); // Assign role admin ke pengguna admin

        // Tambahkan pengguna biasa
        $normalUser = User::firstOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name' => 'User',
                'password' => bcrypt('citarum01') // Ganti dengan password yang aman
            ]
        );
        $normalUser->assignRole($userRole); // Assign role user ke pengguna biasa

    }
}
