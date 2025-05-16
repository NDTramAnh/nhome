<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('suppliers')->insert([
            ['name_supplier' => 'Công ty TNHH Mỹ phẩm ABC', 'phone_supplier' => '0901234567', 'email' => 'abc@gmail.com', 'address' => '123 Đường A, Quận 1, TP.HCM'],
            ['name_supplier' => 'Nhà phân phối Skincare XYZ', 'phone_supplier' => '0912345678', 'email' => 'xyz@skincare.com', 'address' => '456 Đường B, Quận 2, TP.HCM'],
            ['name_supplier' => 'Công ty Dược phẩm BeautyCare', 'phone_supplier' => '0987654321', 'email' => 'beautycare@mail.com', 'address' => '789 Đường C, Quận 3, TP.HCM'],
            ['name_supplier' => 'Nhà cung cấp CosmeShop', 'phone_supplier' => '0975312345', 'email' => 'contact@cosmeshop.com', 'address' => '101 Đường D, Hà Nội'],
        ]);
    }
}
