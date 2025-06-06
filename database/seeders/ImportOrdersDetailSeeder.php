<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportOrdersDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('import_orders_detail')->insert([
            [
                'id_import' => 1,
                'id_product' => 2,
                'quantity' => 100,
                'price' => 120000.00,
            ],
            [
                'id_import' => 1,
                'id_product' => 5,
                'quantity' => 100,
                'price' => 120000.00,
            ],
            [
                'id_import' => 2,
                'id_product' => 3,
                'quantity' => 200,
                'price' => 180000.00,
            ],
            [
                'id_import' => 2,
                'id_product' => 1,
                'quantity' => 200,
                'price' => 180000.00,
            ],
            [
                'id_import' => 3,
                'id_product' => 7,
                'quantity' => 150,
                'price' => 320000.00,
            ],
            [
                'id_import' => 3,
                'id_product' => 2,
                'quantity' => 150,
                'price' => 320000.00,
            ],
            [
                'id_import' => 4,
                'id_product' => 1,
                'quantity' => 80,
                'price' => 150000.00,
            ],
            [
                'id_import' => 4,
                'id_product' => 4,
                'quantity' => 80,
                'price' => 150000.00,
            ],
            [
                'id_import' => 5,
                'id_product' => 6,
                'quantity' => 100,
                'price' => 250000.00,
            ],
            [
                'id_import' => 5,
                'id_product' => 9,
                'quantity' => 100,
                'price' => 250000.00,
            ],
        ]);
    }
}
