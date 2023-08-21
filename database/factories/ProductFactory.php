<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
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
            'category_id' => Category::inRandomOrder()->first()->id,
            'brand_id' =>  Brand::inRandomOrder()->first()->id,
            'user_id' =>  User::inRandomOrder()->first()->id,
            'active' => fake()->boolean(),
            'sort' => fake()->numberBetween(1, 1000),
        ];
    }
}
