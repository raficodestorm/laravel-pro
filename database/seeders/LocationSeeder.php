<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $locations = [
            // Dhaka Division
            ['district' => 'Dhaka', 'division' => 'Dhaka'],
            ['district' => 'Faridpur', 'division' => 'Dhaka'],
            ['district' => 'Gazipur', 'division' => 'Dhaka'],
            ['district' => 'Gopalganj', 'division' => 'Dhaka'],
            ['district' => 'Kishoreganj', 'division' => 'Dhaka'],
            ['district' => 'Madaripur', 'division' => 'Dhaka'],
            ['district' => 'Manikganj', 'division' => 'Dhaka'],
            ['district' => 'Munshiganj', 'division' => 'Dhaka'],
            ['district' => 'Narayanganj', 'division' => 'Dhaka'],
            ['district' => 'Narsingdi', 'division' => 'Dhaka'],
            ['district' => 'Rajbari', 'division' => 'Dhaka'],
            ['district' => 'Shariatpur', 'division' => 'Dhaka'],
            ['district' => 'Tangail', 'division' => 'Dhaka'],

            // Chattogram Division
            ['district' => 'Bandarban', 'division' => 'Chattogram'],
            ['district' => 'Brahmanbaria', 'division' => 'Chattogram'],
            ['district' => 'Chandpur', 'division' => 'Chattogram'],
            ['district' => 'Chattogram', 'division' => 'Chattogram'],
            ['district' => 'Cumilla', 'division' => 'Chattogram'],
            ['district' => 'Cox’s Bazar', 'division' => 'Chattogram'],
            ['district' => 'Feni', 'division' => 'Chattogram'],
            ['district' => 'Khagrachhari', 'division' => 'Chattogram'],
            ['district' => 'Lakshmipur', 'division' => 'Chattogram'],
            ['district' => 'Noakhali', 'division' => 'Chattogram'],
            ['district' => 'Rangamati', 'division' => 'Chattogram'],

            // Rajshahi Division
            ['district' => 'Bogura', 'division' => 'Rajshahi'],
            ['district' => 'Joypurhat', 'division' => 'Rajshahi'],
            ['district' => 'Naogaon', 'division' => 'Rajshahi'],
            ['district' => 'Natore', 'division' => 'Rajshahi'],
            ['district' => 'Chapainawabganj', 'division' => 'Rajshahi'],
            ['district' => 'Pabna', 'division' => 'Rajshahi'],
            ['district' => 'Rajshahi', 'division' => 'Rajshahi'],
            ['district' => 'Sirajganj', 'division' => 'Rajshahi'],

            // Khulna Division
            ['district' => 'Bagerhat', 'division' => 'Khulna'],
            ['district' => 'Chuadanga', 'division' => 'Khulna'],
            ['district' => 'Jashore', 'division' => 'Khulna'],
            ['district' => 'Jhenaidah', 'division' => 'Khulna'],
            ['district' => 'Khulna', 'division' => 'Khulna'],
            ['district' => 'Kushtia', 'division' => 'Khulna'],
            ['district' => 'Magura', 'division' => 'Khulna'],
            ['district' => 'Meherpur', 'division' => 'Khulna'],
            ['district' => 'Narail', 'division' => 'Khulna'],
            ['district' => 'Satkhira', 'division' => 'Khulna'],

            // Barishal Division
            ['district' => 'Barguna', 'division' => 'Barishal'],
            ['district' => 'Barishal', 'division' => 'Barishal'],
            ['district' => 'Bhola', 'division' => 'Barishal'],
            ['district' => 'Jhalokathi', 'division' => 'Barishal'],
            ['district' => 'Patuakhali', 'division' => 'Barishal'],
            ['district' => 'Pirojpur', 'division' => 'Barishal'],

            // Sylhet Division
            ['district' => 'Habiganj', 'division' => 'Sylhet'],
            ['district' => 'Moulvibazar', 'division' => 'Sylhet'],
            ['district' => 'Sunamganj', 'division' => 'Sylhet'],
            ['district' => 'Sylhet', 'division' => 'Sylhet'],

            // Rangpur Division
            ['district' => 'Dinajpur', 'division' => 'Rangpur'],
            ['district' => 'Gaibandha', 'division' => 'Rangpur'],
            ['district' => 'Kurigram', 'division' => 'Rangpur'],
            ['district' => 'Lalmonirhat', 'division' => 'Rangpur'],
            ['district' => 'Nilphamari', 'division' => 'Rangpur'],
            ['district' => 'Panchagarh', 'division' => 'Rangpur'],
            ['district' => 'Rangpur', 'division' => 'Rangpur'],
            ['district' => 'Thakurgaon', 'division' => 'Rangpur'],

            // Mymensingh Division
            ['district' => 'Jamalpur', 'division' => 'Mymensingh'],
            ['district' => 'Mymensingh', 'division' => 'Mymensingh'],
            ['district' => 'Netrokona', 'division' => 'Mymensingh'],
            ['district' => 'Sherpur', 'division' => 'Mymensingh'],
        ];

        Location::insert($locations);
    }
}
