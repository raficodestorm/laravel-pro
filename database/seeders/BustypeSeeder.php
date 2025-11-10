<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bustype;

class BustypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bustypes = [
            // Dhaka Division
            ['type' => 'AC-Business'],
            ['type' => 'AC-Economic'],
            ['type' => 'Non-AC'],
            ['type' => 'Sleeper-single-decker'],
            ['type' => 'Sleeper-double-decker'],
            
        ];

        Bustype::insert($bustypes);
    }
}
