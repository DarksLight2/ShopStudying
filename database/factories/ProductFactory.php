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
    public function definition()
    {
        return [
            'title' => fake()->text(),
            'price' => fake()->numberBetween(0, 1000),
            'discount' => rand(0, 100),
            'thumbnail' => fake()->image('public/storage/images/products'),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
        ];
    }
}
