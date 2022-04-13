<?php

namespace Database\Seeders;

use App\Models\ProductProductCategory;
use Illuminate\Database\Seeder;

class ProductProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductProductCategory::factory()->count(1000)->create();
    }
}
