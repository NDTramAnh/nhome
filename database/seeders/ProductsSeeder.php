<?php

namespace Database\Seeders;

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

            ['name_product' => 'Sữa rửa mặt dịu nhẹ', 'category' => 'Skincare', 'price' => 150000, 'quantity' => 50, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Kem dưỡng ẩm ban ngày', 'category' => 'Skincare', 'price' => 250000, 'quantity' => 40, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Tinh chất chống lão hóa', 'category' => 'Skincare', 'price' => 400000, 'quantity' => 30, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Mặt nạ ngủ phục hồi', 'category' => 'Skincare', 'price' => 350000, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Kem chống nắng SPF50+', 'category' => 'Skincare', 'price' => 300000, 'quantity' => 60, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Nước hoa hồng làm sạch sâu', 'category' => 'Skincare', 'price' => 180000, 'quantity' => 55, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Sữa tẩy trang dịu nhẹ', 'category' => 'Skincare', 'price' => 160000, 'quantity' => 45, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Gel trị mụn nhanh', 'category' => 'Skincare', 'price' => 200000, 'quantity' => 35, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Kem dưỡng ban đêm', 'category' => 'Skincare', 'price' => 270000, 'quantity' => 25, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Serum làm sáng da', 'category' => 'Skincare', 'price' => 450000, 'quantity' => 30, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Mặt nạ đất sét', 'category' => 'Skincare', 'price' => 220000, 'quantity' => 40, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Toner làm dịu da', 'category' => 'Skincare', 'price' => 170000, 'quantity' => 50, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Kem mắt giảm thâm', 'category' => 'Skincare', 'price' => 320000, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Xịt khoáng dưỡng ẩm', 'category' => 'Skincare', 'price' => 150000, 'quantity' => 60, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name_product' => 'Tẩy tế bào chết dịu nhẹ', 'category' => 'Skincare', 'price' => 180000, 'quantity' => 30, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],

        ]);
    }
}
