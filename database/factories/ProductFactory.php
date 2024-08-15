<?php

namespace Database\Factories;

use App\Models\Products\Brand;
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
        $brand_id = Brand::select('id')->inRandomOrder()->first();

        return [
            'name' => $this->translations('id', fake()->words(3, true)),
            'brand_id' => $brand_id,
            'description' => $this->translations('id', fake()->paragraph()),
            'have_video' => fake()->randomElement([true, false]),
            'video_link' => fake()->url(),
            'buy_link' => fake()->url(),
        ];
    }
}
