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
            ['name' => 'Gel rửa mặt sạch sâu', 'category' => 'Skincare', 'price' => 145000, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Kem dưỡng ẩm dịu nhẹ', 'category' => 'Skincare', 'price' => 240000, 'quantity' => 10, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Serum dưỡng trắng da', 'category' => 'Skincare', 'price' => 360000, 'quantity' => 25, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Mặt nạ cấp ẩm cấp tốc', 'category' => 'Skincare', 'price' => 290000, 'quantity' => 50, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Kem chống nắng toàn thân', 'category' => 'Skincare', 'price' => 310000, 'quantity' => 75, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Sữa rửa mặt trà xanh', 'category' => 'Skincare', 'price' => 160000, 'quantity' => 100, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Tinh chất dưỡng ẩm sâu', 'category' => 'Skincare', 'price' => 380000, 'quantity' => 120, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Toner hoa cúc dịu nhẹ', 'category' => 'Skincare', 'price' => 175000, 'quantity' => 150, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Kem dưỡng nâng tông', 'category' => 'Skincare', 'price' => 295000, 'quantity' => 180, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Mặt nạ làm dịu da mụn', 'category' => 'Skincare', 'price' => 250000, 'quantity' => 200, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Sữa rửa mặt ngừa mụn', 'category' => 'Skincare', 'price' => 155000, 'quantity' => 1, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Kem dưỡng tái tạo da', 'category' => 'Skincare', 'price' => 275000, 'quantity' => 20, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Tinh chất Vitamin C', 'category' => 'Skincare', 'price' => 380000, 'quantity' => 45, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Mặt nạ dưỡng trắng', 'category' => 'Skincare', 'price' => 210000, 'quantity' => 65, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Kem chống nắng kiểm dầu', 'category' => 'Skincare', 'price' => 295000, 'quantity' => 85, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Toner hoa hồng', 'category' => 'Skincare', 'price' => 165000, 'quantity' => 110, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Xịt khoáng dưỡng da', 'category' => 'Skincare', 'price' => 195000, 'quantity' => 140, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Sữa dưỡng da sáng mịn', 'category' => 'Skincare', 'price' => 225000, 'quantity' => 170, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Kem trị nám hiệu quả', 'category' => 'Skincare', 'price' => 430000, 'quantity' => 190, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
            ['name' => 'Serum phục hồi da tổn thương', 'category' => 'Skincare', 'price' => 460000, 'quantity' => 200, 'created_at' => now(), 'updated_at' => now(), 'status' => 1],
        ]);
    }
}
