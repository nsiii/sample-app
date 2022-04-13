<?php

namespace Database\Factories;

use App\Models\ProductProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductProductCategoryFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ProductProductCategory::class;
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'product_id' => $this->faker->numberBetween(1, 1000),
            'product_category_id' => $this->faker->numberBetween(7, 26)
        ];
    }
}
