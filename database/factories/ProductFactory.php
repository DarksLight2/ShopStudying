<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->text(10),
            'price' => fake()->numberBetween(0, 1000),
            'discount' => rand(0, 100),
            'thumbnail' => fake()->fixturesImage('products', 'images/products'),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
        ];
    }
}
