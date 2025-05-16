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
            ['id_export' => 1, 'id_product' => 5, 'quantity' => 10, 'price' => 250000.00],
            ['id_export' => 2, 'id_product' => 3, 'quantity' => 5, 'price' => 180000.00],
            ['id_export' => 3, 'id_product' => 7, 'quantity' => 8, 'price' => 320000.00],
            ['id_export' => 4, 'id_product' => 2, 'quantity' => 15, 'price' => 150000.00],
        ]);
    }
}
