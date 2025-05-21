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
<<<<<<< HEAD
            ['name_product' => 'Sữa rửa mặt CeraVe', 'id_category' => '1', 'price' => 250000.00, 'stock_quantity' => 50, 'status' => 1],
            ['name_product' => 'Kem dưỡng ẩm La Roche', 'id_category' => '2', 'price' => 450000.00, 'stock_quantity' => 30, 'status' => 1],
            ['name_product' => 'Serum Vitamin C', 'id_category' => '3', 'price' => 380000.00, 'stock_quantity' => 20, 'status' => 1],
            ['name_product' => 'Kem chống nắng Anessa', 'id_category' => '4', 'price' => 500000.00, 'stock_quantity' => 40, 'status' => 1],
=======
            ['name' => 'Sữa rửa mặt dịu nhẹ', 'category' => 'Skincare', 'price' => 150000, 'quantity' => 50, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Kem dưỡng ẩm ban ngày', 'category' => 'Skincare', 'price' => 250000, 'quantity' => 40, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Tinh chất chống lão hóa', 'category' => 'Skincare', 'price' => 400000, 'quantity' => 30, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Mặt nạ ngủ phục hồi', 'category' => 'Skincare', 'price' => 350000, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Kem chống nắng SPF50+', 'category' => 'Skincare', 'price' => 300000, 'quantity' => 60, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Nước hoa hồng làm sạch sâu', 'category' => 'Skincare', 'price' => 180000, 'quantity' => 55, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Sữa tẩy trang dịu nhẹ', 'category' => 'Skincare', 'price' => 160000, 'quantity' => 45, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Gel trị mụn nhanh', 'category' => 'Skincare', 'price' => 200000, 'quantity' => 35, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Kem dưỡng ban đêm', 'category' => 'Skincare', 'price' => 270000, 'quantity' => 25, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Serum làm sáng da', 'category' => 'Skincare', 'price' => 450000, 'quantity' => 30, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Mặt nạ đất sét', 'category' => 'Skincare', 'price' => 220000, 'quantity' => 40, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Toner làm dịu da', 'category' => 'Skincare', 'price' => 170000, 'quantity' => 50, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Kem mắt giảm thâm', 'category' => 'Skincare', 'price' => 320000, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Xịt khoáng dưỡng ẩm', 'category' => 'Skincare', 'price' => 150000, 'quantity' => 60, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Tẩy tế bào chết dịu nhẹ', 'category' => 'Skincare', 'price' => 180000, 'quantity' => 30, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
>>>>>>> export-order
        ]);
    }
}
