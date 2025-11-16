<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Size::create(['name' => '180x200 cm (No. 1)']);
        Size::create(['name' => '160x200 cm (No. 2)']);
        Size::create(['name' => '120x200 cm (No. 3)']);
        Size::create(['name' => '90x200 cm (No. 4)']);
    }
}
