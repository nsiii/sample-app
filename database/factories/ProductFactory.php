<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'store_id' => $this->faker->numberBetween(1,50),
            'purchase_detail_history_id' => $this->faker->numberBetween(1,50),
            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(4),
            'stock' => $this->faker->randomNumber(2)
        ];
    }
}
