<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class ExportOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('export_orders')->insert([
            ['id_user' => 1, 'id_customer' => 3, 'total_price' => 500000.00, 'create_at' => '2025-03-22 03:00:00'],
            ['id_user' => 2, 'id_customer' => 5, 'total_price' => 750000.00, 'create_at' => '2025-03-22 04:30:00'],
            ['id_user' => 3, 'id_customer' => 8, 'total_price' => 1200000.00, 'create_at' => '2025-03-22 07:15:00'],
            ['id_user' => 4, 'id_customer' => 2, 'total_price' => 340000.00, 'create_at' => '2025-03-22 09:00:00'],
            ['id_user' => 1, 'id_customer' => 7, 'total_price' => 990000.00, 'create_at' => '2025-03-22 11:45:00'],
        ]);
    }
}
