<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [   
                'name' => 'Cloth Bag (4*6)',
                'description' => 'Cloth Bag (4*6)',
                'hsnCode'=>789012,
                'price' => 3.55,
                'stock' => 40000,
                'quantity' => 1,
                'uom' => 'Nos',
                'status' => 'active',
            ],
            [   
                'name' => 'Cloth Bag (8*10)',
                'description' => 'Cloth Bag (8*10)',
                'hsnCode'=>789013,
                'price' => 9.00,
                'stock' => 40000,
                'quantity' => 1,
                'uom' => 'Nos',
                'status' => 'active',
            ],
            // Add more product data as needed
        ];

        // Insert the data into the "products" table
        foreach ($products as $product) {
            Product::insert($product);
        }
    }
}
