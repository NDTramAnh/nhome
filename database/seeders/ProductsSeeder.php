<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([
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
            ['name' => 'Sữa rửa mặt tạo bọt', 'category' => 'Skincare', 'price' => 160000, 'quantity' => 40, 'created_at' => Carbon::parse('2025-06-05 09:00:00'), 'updated_at' => Carbon::parse('2025-06-05 09:00:00'), 'status' => 1],
            ['name' => 'Kem dưỡng da ban đêm chống lão hóa', 'category' => 'Skincare', 'price' => 320000, 'quantity' => 30, 'created_at' => Carbon::parse('2025-06-20 10:30:00'), 'updated_at' => Carbon::parse('2025-06-20 10:30:00'), 'status' => 1],
            ['name' => 'Serum dưỡng trắng da', 'category' => 'Skincare', 'price' => 400000, 'quantity' => 25, 'created_at' => Carbon::parse('2025-07-05 08:45:00'), 'updated_at' => Carbon::parse('2025-07-05 08:45:00'), 'status' => 1],
            ['name' => 'Mặt nạ thải độc da', 'category' => 'Skincare', 'price' => 210000, 'quantity' => 35, 'created_at' => Carbon::parse('2025-07-20 09:15:00'), 'updated_at' => Carbon::parse('2025-07-20 09:15:00'), 'status' => 1],
            ['name' => 'Kem chống nắng vật lý', 'category' => 'Skincare', 'price' => 290000, 'quantity' => 50, 'created_at' => Carbon::parse('2025-08-05 11:00:00'), 'updated_at' => Carbon::parse('2025-08-05 11:00:00'), 'status' => 1],
            ['name' => 'Toner cân bằng da', 'category' => 'Skincare', 'price' => 180000, 'quantity' => 45, 'created_at' => Carbon::parse('2025-08-20 10:00:00'), 'updated_at' => Carbon::parse('2025-08-20 10:00:00'), 'status' => 1],
            ['name' => 'Gel trị mụn chuyên sâu', 'category' => 'Skincare', 'price' => 230000, 'quantity' => 40, 'created_at' => Carbon::parse('2025-09-05 09:30:00'), 'updated_at' => Carbon::parse('2025-09-05 09:30:00'), 'status' => 1],
            ['name' => 'Sữa dưỡng thể hương hoa nhài', 'category' => 'Skincare', 'price' => 190000, 'quantity' => 60, 'created_at' => Carbon::parse('2025-09-20 08:00:00'), 'updated_at' => Carbon::parse('2025-09-20 08:00:00'), 'status' => 1],
            ['name' => 'Serum phục hồi da nhạy cảm', 'category' => 'Skincare', 'price' => 420000, 'quantity' => 30, 'created_at' => Carbon::parse('2025-10-05 10:30:00'), 'updated_at' => Carbon::parse('2025-10-05 10:30:00'), 'status' => 1],
            ['name' => 'Mặt nạ dưỡng ẩm sâu', 'category' => 'Skincare', 'price' => 240000, 'quantity' => 35, 'created_at' => Carbon::parse('2025-10-20 09:45:00'), 'updated_at' => Carbon::parse('2025-10-20 09:45:00'), 'status' => 1],
            ['name' => 'Kem mắt chống nhăn', 'category' => 'Skincare', 'price' => 310000, 'quantity' => 20, 'created_at' => Carbon::parse('2025-11-05 11:00:00'), 'updated_at' => Carbon::parse('2025-11-05 11:00:00'), 'status' => 1],
            ['name' => 'Xịt khoáng làm dịu da', 'category' => 'Skincare', 'price' => 160000, 'quantity' => 55, 'created_at' => Carbon::parse('2025-11-20 10:00:00'), 'updated_at' => Carbon::parse('2025-11-20 10:00:00'), 'status' => 1],
            ['name' => 'Tẩy tế bào chết hóa học', 'category' => 'Skincare', 'price' => 200000, 'quantity' => 30, 'created_at' => Carbon::parse('2025-12-05 09:00:00'), 'updated_at' => Carbon::parse('2025-12-05 09:00:00'), 'status' => 1],
            ['name' => 'Tinh chất vitamin E', 'category' => 'Skincare', 'price' => 460000, 'quantity' => 25, 'created_at' => Carbon::parse('2025-12-20 11:00:00'), 'updated_at' => Carbon::parse('2025-12-20 11:00:00'), 'status' => 1],
            ['name' => 'Kem dưỡng ẩm chống lão hóa', 'category' => 'Skincare', 'price' => 280000, 'quantity' => 20, 'created_at' => Carbon::parse('2026-01-05 09:30:00'), 'updated_at' => Carbon::parse('2026-01-05 09:30:00'), 'status' => 1],
            ['name' => 'Serum làm đều màu da', 'category' => 'Skincare', 'price' => 370000, 'quantity' => 30, 'created_at' => Carbon::parse('2026-01-15 10:15:00'), 'updated_at' => Carbon::parse('2026-01-15 10:15:00'), 'status' => 1],
            ['name' => 'Mặt nạ collagen', 'category' => 'Skincare', 'price' => 260000, 'quantity' => 40, 'created_at' => Carbon::parse('2026-01-20 09:00:00'), 'updated_at' => Carbon::parse('2026-01-20 09:00:00'), 'status' => 1],
            ['name' => 'Gel dưỡng da ban ngày', 'category' => 'Skincare', 'price' => 210000, 'quantity' => 45, 'created_at' => Carbon::parse('2026-01-25 08:30:00'), 'updated_at' => Carbon::parse('2026-01-25 08:30:00'), 'status' => 1],
            ['name' => 'Kem chống nắng cho da nhạy cảm', 'category' => 'Skincare', 'price' => 300000, 'quantity' => 50, 'created_at' => Carbon::parse('2026-01-28 09:00:00'), 'updated_at' => Carbon::parse('2026-01-28 09:00:00'), 'status' => 1],
        ]);
    }
}
