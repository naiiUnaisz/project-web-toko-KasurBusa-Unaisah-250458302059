<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Brand::truncate();

        Schema::enableForeignKeyConstraints();
   
        Brand::create(['name' => 'Royal', 'slug' => 'royal']);
        Brand::create(['name' => 'Inoac', 'slug' => 'inoac']);
        Brand::create(['name' => 'Yukata', 'slug' => 'yukata']);
        
    }
}
