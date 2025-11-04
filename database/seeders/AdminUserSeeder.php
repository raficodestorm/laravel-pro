<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->updateOrInsert(
            ['email' => 'admin@system.com'], // Unique identifier
            [
                'fullname' => 'System Administrator',
                'username' => 'admin',
                'password' => Hash::make('admin12345'), // change later
                'role' => 'admin',
                'status' => 'active',
                'phone' => '01700000000',
                'address' => 'Head Office',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}
