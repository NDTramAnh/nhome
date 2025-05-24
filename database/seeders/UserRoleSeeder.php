<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserRoleSeeder extends Seeder
{
    const MAX_RECORDS = 100;

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= self::MAX_RECORDS; $i++) {
            DB::table('user_role')->insert([
                'user_id' => $i,
                'role_id' => $i === 1 ? 1 : 4, // id 1 là admin, còn lại là member
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
