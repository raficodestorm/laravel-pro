<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Route;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = [
            // From Dhaka
            ['route_code' => 'D2C', 'start_location' => 'Dhaka', 'end_location' => 'Chattogram', 'distance' => '265 km', 'duration' => '6 hours'],
            ['route_code' => 'C2D', 'start_location' => 'Chattogram', 'end_location' => 'Dhaka', 'distance' => '265 km', 'duration' => '6 hours'],
            ['route_code' => 'D2Cx', 'start_location' => 'Dhaka', 'end_location' => 'Cox’s Bazar', 'distance' => '420 km', 'duration' => '8.5 hours'],
            ['route_code' => 'Cx2D', 'start_location' => 'Cox’s Bazar', 'end_location' => 'Dhaka', 'distance' => '420 km', 'duration' => '8.5 hours'],
            ['route_code' => 'D2Bn', 'start_location' => 'Dhaka', 'end_location' => 'Bandarban', 'distance' => '370 km', 'duration' => '9 hours'],
            ['route_code' => 'Bn2D', 'start_location' => 'Bandarban', 'end_location' => 'Dhaka', 'distance' => '370 km', 'duration' => '9 hours'],
            ['route_code' => 'D2Mr', 'start_location' => 'Dhaka', 'end_location' => 'Moulvibazar', 'distance' => '260 km', 'duration' => '6 hours'],
            ['route_code' => 'Mr2D', 'start_location' => 'Moulvibazar', 'end_location' => 'Dhaka', 'distance' => '260 km', 'duration' => '6 hours'],

        ];

        Route::insert($routes);
    }
}
