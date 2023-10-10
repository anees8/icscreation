<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'id' => 1,
                'name' => 'Admin',
                'slug' => 'admin',
            ],
            [
                'id' => 2,
                'name' => 'User',
                'slug' => 'user',
            ],
            // Add more roles here
        ];

        foreach ($roles as $roleData) {
            $role = Role::create($roleData);
            if($role->id==1){
            $role->permissions()->sync(range(1,28));
            }else{
                $role->permissions()->sync(range(1,21));
            }   
        }
        
    }
}
