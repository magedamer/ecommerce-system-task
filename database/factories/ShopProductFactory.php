<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use App\Models\Product;
use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ShopProduct>
 */
class ShopProductFactory extends Factory
{
    protected $model = ShopProduct::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => fn () => User::factory()->create()->id,
            'product_id' => fn () => Product::factory()->create()->id,
            'category_id' => fn () => Category::factory()->create()->id,
            'quantity' => $quantity = $this->faker->randomDigit,
            'unit_price' => $unitPrice = $this->faker->randomFloat(0, 1000, 2),
            'total_price' => $quantity * $unitPrice,
        ];
    }
}
