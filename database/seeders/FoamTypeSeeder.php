<?php

namespace Database\Seeders;

use App\Models\JenisBusa;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoamTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        JenisBusa::create(['name' => 'Density 23 (D23)']);
        JenisBusa::create(['name' => 'Density 24 (D24)']);
        JenisBusa::create(['name' => 'Rebonded']);
        JenisBusa::create(['name' => 'Density 25 (D25)']);
    }
}
