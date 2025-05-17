<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([

            ['name_product' => 'Sữa rửa mặt CeraVe', 'id_category' => '1', 'price' => 250000.00, 'stock_quantity' => 50, 'status' => 1],
            ['name_product' => 'Kem dưỡng ẩm La Roche', 'id_category' => '2', 'price' => 450000.00, 'stock_quantity' => 30, 'status' => 1],
            ['name_product' => 'Serum Vitamin C', 'id_category' => '3', 'price' => 380000.00, 'stock_quantity' => 20, 'status' => 1],
            ['name_product' => 'Kem chống nắng Anessa', 'id_category' => '4', 'price' => 500000.00, 'stock_quantity' => 40, 'status' => 1],

        ]);

    }
}
