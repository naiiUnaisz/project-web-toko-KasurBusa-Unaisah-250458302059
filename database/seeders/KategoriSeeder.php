<?php

namespace Database\Seeders;

use App\Models\Kategori;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kategori::truncate();

        // Buat data baru
        Kategori::create(['name' => 'Kasur Busa']);
        Kategori::create(['name' => 'Kasur Springbed']);
        Kategori::create(['name' => 'Kasur Lipat']);
        Kategori::create(['name' => 'Busa Lembaran']);
    }
}
