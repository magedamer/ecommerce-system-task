<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\ShopProduct;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    protected $model = Order::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shop_product_id' => $shopProductId = fn () => ShopProduct::factory()->create()->id,
            'order_number' => 'ORD-'.uniqid(),
            'quantity' => $quantity = $this->faker->randomDigit,
            'unit_price' => $unitPrice = ShopProduct::where('id', $shopProductId())->value('unit_price'),
            'total_price' => $quantity * $unitPrice,
        ];
    }
}
