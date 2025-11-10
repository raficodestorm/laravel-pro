<?php

namespace Database\Seeders;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
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
        $now = Carbon::now();

        $users = [
            [
                'fullname' => 'Mr. Admin',
                'username' => 'admin',
                'email' => 'admin@system.com',
                'password' => Hash::make('admin12345'),
                'role' => 'admin',
                'status' => 'active',
                'phone' => '01700000000',
                'address' => 'Head Office',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'fullname' => 'Mr. Manager',
                'username' => 'manager',
                'email' => 'counter@system.com',
                'password' => Hash::make('manager12345'),
                'role' => 'counter_manager',
                'status' => 'active',
                'phone' => '01711111111',
                'address' => 'Bus Counter Office',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'fullname' => 'Mr. Controller',
                'username' => 'controller',
                'email' => 'controller@system.com',
                'password' => Hash::make('controller12345'),
                'role' => 'controller',
                'status' => 'active',
                'phone' => '01722222222',
                'address' => 'Main Control Office',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        foreach ($users as $user) {
            DB::table('users')->updateOrInsert(
                ['email' => $user['email']],
                $user
            );
        }
    }
}
