<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => CategoryFactory::new()->create()->id,
            'subcategory_id' => CategoryFactory::new()->create()->id,
            'name' => $this->faker->word,
            'description' => $this->faker->sentence,
            'quantity' => $this->faker->randomDigit,
            'unit_price' => $this->faker->randomFloat(0, 1000, 2),
            'status' => $this->faker->randomElement(['active', 'inactive']),
        ];
    }
}
