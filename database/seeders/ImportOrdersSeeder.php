<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportOrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('import_orders')->insert([
            ['supplier_id' => 1, 'user_id' => 2, 'total_price' => 24500000.00, 'import_date' => '2025-03-22 01:18:24'],
            ['supplier_id' => 2, 'user_id' => 3, 'total_price' => 36000000.00, 'import_date' => '2025-03-22 01:18:24'],
            ['supplier_id' => 3, 'user_id' => 1, 'total_price' => 48000000.00, 'import_date' => '2025-03-22 01:18:24'],
            ['supplier_id' => 4, 'user_id' => 2, 'total_price' => 12000000.00, 'import_date' => '2025-03-22 01:18:24'],
            ['supplier_id' => 1, 'user_id' => 2, 'total_price' => 24500000.00, 'import_date' => '2025-03-22 01:18:24'],
            ['supplier_id' => 2, 'user_id' => 3, 'total_price' => 36000000.00, 'import_date' => '2025-03-22 01:18:24'],
            ['supplier_id' => 3, 'user_id' => 1, 'total_price' => 48000000.00, 'import_date' => '2025-03-22 01:18:24'],
            ['supplier_id' => 4, 'user_id' => 2, 'total_price' => 12000000.00, 'import_date' => '2025-03-22 01:18:24'],
        ]);
    }
}
