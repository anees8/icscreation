<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Customer;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $customer = [
        [
            'id' => 1,
            'name'=>'Test',
            'phone'=>'9876543210',
            'email'=>'test@yopmail.com',
            'company_name'=>'Test Company',
            'address'=>'#255 Shop.1, A.S.Char Street,Bangalore -2 ,Karnataka',
            'delivery_address'=>'#255 Shop.1, A.S.Char Street,Bangalore -2 ,Karnataka',
            'contact_person'=>'Test Reciver',
            'contact_number'=>'9123456789',
            'gst_number'=>'49ADMKM5544J1ZR',
        ],
        
        
        // Add more Customers here
    ];

    Customer::insert($customer);
    }
}
