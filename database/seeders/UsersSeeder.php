<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Nguyễn Văn A',
                'email' => 'nguyenvana@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('123456'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Trần Thị B',
                'email' => 'tranthib@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('abcdef'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Lê Quốc C',
                'email' => 'lequocc@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('password123'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Phạm Minh D',
                'email' => 'phamminhd@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('qwerty789'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Hoàng Mai E',
                'email' => 'hoangmaie@example.com',
                'email_verified_at' => now(),
                'password' => Hash::make('skincare@2025'),
                'remember_token' => Str::random(10),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
