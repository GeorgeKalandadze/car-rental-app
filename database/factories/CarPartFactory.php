<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CarPart>
 */
class CarPartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::factory()->create();

        return [
            'user_id' => $user->id,
            'model_id' => 1,
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(100, 2000),
            'condition' => $this->faker->randomElement(['new', 'used']),
            'brand_id' => 1,
            'category_id' => 1
        ];
    }
}
