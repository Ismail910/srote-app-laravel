<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Categories;
use App\Models\product;
use App\Models\Stores;
use Illuminate\Database\Seeder;
use Symfony\Component\HttpKernel\HttpCache\Store;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        Stores::factory(5)->create();
        Categories::factory(10)->create();
        product::factory(100)->create();

        // $this->call(UserSeeder::class); 


    }
}
