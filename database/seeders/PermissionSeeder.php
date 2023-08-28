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
                'name' => 'User Create',
                'slug' => 'user_create',
            ],
            [
                'id' => 2,
                'name' => 'User Delete',
                'slug' => 'user_delete',
            ],
            // Add more permissions here
        ];

        Permission::insert($permissions);
    }
}
