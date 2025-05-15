<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name_cate' => 'Sửa rửa mặt'],
            ['name_cate' => 'Cream'],
            ['name_cate' => 'Serum'],
            ['name_cate' => 'Kem chống nắng'],
            ['name_cate' => 'Toner'],
            ['name_cate' => 'Mask'],
            ['name_cate' => 'Tẩy trang'],
        ]);
    }
}
