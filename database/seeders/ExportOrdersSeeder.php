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
            [
                'id_user' => 1,
                'id_customer' => 'Customer A',
                'total_price' => 150.50,
                'created_at' => now()->subDays(10),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'id_customer' => 'Customer B',
                'total_price' => 230.00,
                'created_at' => now()->subDays(9),
                'updated_at' => now(),
            ],
            [
                'id_user' => 3,
                'id_customer' => 'Customer C',
                'total_price' => 500.75,
                'created_at' => now()->subDays(8),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_customer' => 'Customer D',
                'total_price' => 320.00,
                'created_at' => now()->subDays(7),
                'updated_at' => now(),
            ],
            [
                'id_user' => 4,
                'id_customer' => 'Customer E',
                'total_price' => 100.99,
                'created_at' => now()->subDays(6),
                'updated_at' => now(),
            ],
            [
                'id_user' => 5,
                'id_customer' => 'Customer F',
                'total_price' => 750.00,
                'created_at' => now()->subDays(5),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'id_customer' => 'Customer G',
                'total_price' => 420.30,
                'created_at' => now()->subDays(4),
                'updated_at' => now(),
            ],
            [
                'id_user' => 3,
                'id_customer' => 'Customer H',
                'total_price' => 280.40,
                'created_at' => now()->subDays(3),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_customer' => 'Customer I',
                'total_price' => 610.20,
                'created_at' => now()->subDays(2),
                'updated_at' => now(),
            ],
            [
                'id_user' => 4,
                'id_customer' => 'Customer J',
                'total_price' => 190.00,
                'created_at' => now()->subDays(1),
                'updated_at' => now(),
            ],
            [
                'id_user' => 5,
                'id_customer' => 'Customer K',
                'total_price' => 450.80,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_user' => 2,
                'id_customer' => 'Customer L',
                'total_price' => 380.70,
                'created_at' => now()->subDays(11),
                'updated_at' => now(),
            ],
            [
                'id_user' => 3,
                'id_customer' => 'Customer M',
                'total_price' => 220.00,
                'created_at' => now()->subDays(12),
                'updated_at' => now(),
            ],
            [
                'id_user' => 1,
                'id_customer' => 'Customer N',
                'total_price' => 330.00,
                'created_at' => now()->subDays(13),
                'updated_at' => now(),
            ],
            [
                'id_user' => 4,
                'id_customer' => 'Customer O',
                'total_price' => 140.50,
                'created_at' => now()->subDays(14),
                'updated_at' => now(),
            ],
        ]);
    }
}
