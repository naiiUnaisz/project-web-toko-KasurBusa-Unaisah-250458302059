<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();

        Size::truncate();

        Schema::enableForeignKeyConstraints();
   
        Size::create(['name' => '180x200 cm (No. 1)', 'slug' => 'no-1']);
        Size::create(['name' => '160x200 cm (No. 2)', 'slug' => 'no-2']);
        Size::create(['name' => '120x200 cm (No. 3)', 'slug' => 'no-3']);
        Size::create(['name' => '90x200 cm (No. 4)', 'slug' => 'no-4']);
    }
}
