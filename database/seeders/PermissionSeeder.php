<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Permission;


class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        $permissions = [
            [
                'id' => 1,
                'name' => 'User View Any',
                'slug' => 'user_view_any',
            ],
            [
                'id' => 2,
                'name' => 'User View',
                'slug' => 'user_view',
            ],
            [
                'id' => 3,
                'name' => 'User Create',
                'slug' => 'user_create',
            ],
            [
                'id' => 4,
                'name' => 'User Update',
                'slug' => 'user_update',
            ],
            [
                'id' => 5,
                'name' => 'User Delete',
                'slug' => 'user_delete',
            ],
            [
                'id' => 6,
                'name' => 'User Restore',
                'slug' => 'user_restore',
            ],
            [
                'id' => 7,
                'name' => 'User Force Delete',
                'slug' => 'user_force_delete',
            ],
            [
                'id' => 8,
                'name' => 'Role View Any',
                'slug' => 'role_view_any',
            ],
            [
                'id' => 9,
                'name' => 'Role View',
                'slug' => 'role_view',
            ],
            [
                'id' => 10,
                'name' => 'Role Create',
                'slug' => 'role_create',
            ],
            [
                'id' => 11,
                'name' => 'Role Update',
                'slug' => 'role_update',
            ],
            [
                'id' => 12,
                'name' => 'Role Delete',
                'slug' => 'role_delete',
            ],
            [
                'id' => 13,
                'name' => 'Role Restore',
                'slug' => 'role_restore',
            ],
            [
                'id' => 14,
                'name' => 'Role Force Delete',
                'slug' => 'role_force_delete',
            ],
            [
                'id' => 15,
                'name' => 'Permission View Any',
                'slug' => 'permission_view_any',
            ],
            [
                'id' => 16,
                'name' => 'Permission View',
                'slug' => 'permission_view',
            ],
            [
                'id' => 17,
                'name' => 'Permission Create',
                'slug' => 'permission_create',
            ],
            [
                'id' => 18,
                'name' => 'Permission Update',
                'slug' => 'permission_update',
            ],
            [
                'id' => 19,
                'name' => 'Permission Delete',
                'slug' => 'permission_delete',
            ],
            [
                'id' => 20,
                'name' => 'Permission Restore',
                'slug' => 'permission_restore',
            ],
            [
                'id' => 21,
                'name' => 'Permission Force Delete',
                'slug' => 'permission_force_delete',
            ],
            
            // Add more permissions here
        ];

        Permission::insert($permissions);
    }
}
