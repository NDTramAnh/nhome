<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ExportOdersDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('export_oders_details')->insert([
            ['id_export' => 1,  'id_product' => 5, 'quantity' => 10, 'price' => 250000.00],
            ['id_export' => 2,  'id_product' => 3, 'quantity' => 5,  'price' => 180000.00],
            ['id_export' => 3,  'id_product' => 7, 'quantity' => 8,  'price' => 320000.00],
            ['id_export' => 4,  'id_product' => 2, 'quantity' => 15, 'price' => 150000.00],
            ['id_export' => 5,  'id_product' => 9, 'quantity' => 12, 'price' => 180000.00],
            ['id_export' => 6,  'id_product' => 6, 'quantity' => 7,  'price' => 210000.00],
            ['id_export' => 7,  'id_product' => 1, 'quantity' => 6,  'price' => 175000.00],
            ['id_export' => 8,  'id_product' => 4, 'quantity' => 10, 'price' => 190000.00],
            ['id_export' => 9,  'id_product' => 8, 'quantity' => 5,  'price' => 205000.00],
            ['id_export' => 10, 'id_product' => 2, 'quantity' => 9,  'price' => 160000.00],
            ['id_export' => 11, 'id_product' => 5, 'quantity' => 4,  'price' => 220000.00],
            ['id_export' => 12, 'id_product' => 6, 'quantity' => 11, 'price' => 190000.00],
            ['id_export' => 13, 'id_product' => 3, 'quantity' => 8,  'price' => 200000.00],
            ['id_export' => 14, 'id_product' => 1, 'quantity' => 10, 'price' => 230000.00],
            ['id_export' => 15, 'id_product' => 7, 'quantity' => 7,  'price' => 195000.00],
        ]);
    }
}
