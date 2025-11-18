<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema; 
use App\Models\Kategori;              

class KategoriSeeder extends Seeder
{
    
    public function run(): void
    {
       
        Schema::disableForeignKeyConstraints();
      
        Kategori::truncate();

        Schema::enableForeignKeyConstraints();

        Kategori::create(['name' => 'Kasur Busa', 'slug' => 'kasur-busa']);
        Kategori::create(['name' => 'Kasur Springbed', 'slug' => 'kasur-springbed']);
        Kategori::create(['name' => 'Kasur Lipat', 'slug' => 'kasur-lipat']);
        Kategori::create(['name' => 'Busa Lembaran', 'slug' => 'busa-lembaran']);
    }
}