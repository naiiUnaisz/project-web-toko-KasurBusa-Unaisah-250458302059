<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        
        User::factory()->create([
            'name' => 'Admin User',
            'email' => 'Admin@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'admin', 
        ]);
    
        User::factory()->create([
            'name' => 'User',
            'email' => 'User@gmail.com',
            'password' => bcrypt('123456789'),
            'role' => 'customer', 
        ]);

        $this->call([
            KategoriSeeder::class,
            BrandSeeder::class,
            FoamTypeSeeder::class,
            SizeSeeder::class,
        ]);

    }
}
