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
                'name' => 'users',
                'action'=>'View Any'
            ],
            [
                'id' => 2,
                'name' => 'users',
                'action'=>'View'
            ],
            [
                'id' => 3,
                'name' => 'users',
                'action'=>'Create'
            ],
            [
                'id' => 4,
                'name' => 'users',
                'action'=>'Update'
            ],
            [
                'id' => 5,
                'name' => 'users',
                'action'=>'Delete'
            ],
            [
                'id' => 6,
        
                'name' => 'users',
                'action'=>'Restore'
            ],
            [
                'id' => 7,
                
                'name' => 'users',
                'action'=>'Force Delete'
            ],
            [
                'id' => 8,
                'name' => 'roles',
                'action'=>'View Any'
            ],
            [
                'id' => 9,
                'name' => 'roles',
                'action'=>'View'
            ],
            [
                'id' => 10,
                'name' => 'roles',
                'action'=>'Create'
            ],
            [
                'id' => 11,
            
                'name' => 'roles',
                'action'=>'Update'
            ],
            [
                'id' => 12,
               
                'name' => 'roles',
                'action'=>'Delete'
            ],
            [
                'id' => 13,
              
                'name' => 'roles',
                'action'=>'Restore'
            ],
            [
                'id' => 14,
               
                'name' => 'roles',
                'action'=>'Force Delete'
            ],
            [
                'id' => 15,
               
                'name' => 'permissions',
                'action'=>'View Any'
            ],
            [
                'id' => 16,
               
                'name' => 'permissions',
                'action'=>'View'
            ],
            [
                'id' => 17,
               
                'name' => 'permissions',
                'action'=>'Create'
            ],
            [
                'id' => 18,
                
                'name' => 'permissions',
                'action'=>'Update'
            ],
            [
                'id' => 19,
            
                'name' => 'permissions',
                'action'=>'Delete'
            ],
            [
                'id' => 20,
                'name' => 'permissions',
                'action'=>'Restore'
            ],
            [
                'id' => 21,
                'name' => 'permissions',
                'action'=>'Force Delete'
            ],
            [
                'id' => 22,
                'name' => 'customers',
                'action'=>'View Any'
            ],
            [
                'id' => 23,
                'name' => 'customers',
                'action'=>'View'
            ],
            [
                'id' => 24,
                'name' => 'customers',
                'action'=>'Create'
            ],
            [
                'id' => 25,
                'name' => 'customers',
                'action'=>'Update'
            ],
            [
                'id' => 26,
                'name' => 'customers',
                'action'=>'Delete'
            ],
            [
                'id' => 27,
                'name' => 'customers',
                'action'=>'Restore'
            ],
            [
                'id' => 28,
                'name' => 'customers',
                'action'=>'Force Delete'
            ],
            [
                'id' => 29,
                'name' => 'products',
                'action'=>'View Any'
            ],
            [
                'id' => 30,
                'name' => 'products',
                'action'=>'View'
            ],
            [
                'id' => 31,
                'name' => 'products',
                'action'=>'Create'
            ],
            [
                'id' => 32,
                'name' => 'products',
                'action'=>'Update'
            ],
            [
                'id' => 33,
                'name' => 'products',
                'action'=>'Delete'
            ],
            [
                'id' => 34,
                'name' => 'products',
                'action'=>'Restore'
            ],
            [
                'id' => 35,
                'name' => 'products',
                'action'=>'Force Delete'
            ],
            // Add more products here
        ];

        Permission::insert($permissions);
    }
}
