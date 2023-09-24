<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\{RoleSeeder,PermissionSeeder,CustomerSeeder};
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);  
        $this->call(CustomerSeeder::class);      
        

        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'admin@yopmail.com',
                'password' => bcrypt('admin@123'),
             
            ],
            [
                'id' => 2,
                'name' => 'Users',
                'email' => 'users@yopmail.com',
                'password' => bcrypt('admin@123'),
            ],
        ];

        foreach ($users as $userData) {
            $user = User::create($userData);
            if ($user->id === 1) {
                $user->roles()->sync(1);
            }else{
            $user->roles()->sync(2);
        }
        }
      
    }
}
