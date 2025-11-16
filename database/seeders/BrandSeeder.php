<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::truncate();

        // Buat data baru
        Brand::create(['name' => 'Royal']);
        Brand::create(['name' => 'Inoac']);
        Brand::create(['name' => 'Yukata']);
        
    }
}
