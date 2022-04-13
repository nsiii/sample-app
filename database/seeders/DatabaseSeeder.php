<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(ProductSeeder::class); 
        $this->call(ImageSeeder::class); 
        $this->call(ProductDetailSeeder::class); 
        $this->call(ProductCategorySeeder::class); 
        $this->call(ProductProductCategorySeeder::class); 
    }
}
