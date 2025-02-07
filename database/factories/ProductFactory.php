<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
        $name = $this->faker->unique()->sentence();
        return [
            'user_id' => rand(1, 10),
            'category_id' => rand(1, 10),
            'name' => $name,
            'slug' => str()->slug($name),
            'status' => rand(0, 1),
            'description' => $this->faker->paragraph(),
            'stock' => rand(0, 100),
            'unit_price' => $this->faker->randomFloat(2, 10, 100),
            'seo_keywords' => $this->faker->sentence(),
            'seo_description' => $this->faker->sentence(),
        ];
    }
}
