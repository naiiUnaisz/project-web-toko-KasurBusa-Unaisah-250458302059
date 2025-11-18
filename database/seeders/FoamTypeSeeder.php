<?php

namespace Database\Seeders;

use App\Models\JenisBusa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FoamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        JenisBusa::truncate();

        Schema::enableForeignKeyConstraints();

        JenisBusa::create(['name' => 'Density 23 (D23)', 'slug' => 'density-23']);
        JenisBusa::create(['name' => 'Density 24 (D24)', 'slug' => 'density-24']);
        JenisBusa::create(['name' => 'Rebonded', 'slug' => 'rebonded']);
        JenisBusa::create(['name' => 'Density 25 (D25)', 'slug' => 'density-25']);
    }
}
