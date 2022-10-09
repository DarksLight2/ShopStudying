<?php

namespace Database\Factories;

use App\Models\Category;
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
            'price' => rand(100, 9999),
            'discount' => rand(0, 100),
            'thumbnail' => fake()->image('public/storage/images/products'),
            'description' => fake()->text(400),
            'category_id' => Category::all()->random(1)->first()->id,
        ];
    }
}
