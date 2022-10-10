<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    'name' => 'Admin',
                    'username' => 'admin',
                    'email' => 'admin_email@example.com',
                    'password' => Hash::make('11111111'),
                    'role' => 'admin',
                    'status' => 'active'
                ],
                [
                    'name' => 'Main Vendor',
                    'username' => 'main_vendor',
                    'email' => 'main_vendor@example.com',
                    'password' => Hash::make('11111111'),
                    'role' => 'vendor',
                    'status' => 'active'
                ],
                [
                    'name' => 'Test User',
                    'username' => 'test_user',
                    'email' => 'test_user@example.com',
                    'password' => Hash::make('11111111'),
                    'role' => 'user',
                    'status' => 'active'
                ]
            ]
        );
    }
}
