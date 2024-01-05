<?php

namespace Database\Factories;

use App\Models\Car;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Car>
 */
class CarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Car::class;

    public function definition(): array
    {
        return [
            'make' => $this->faker->word,
            'model' => $this->faker->word,
            'year' => $this->faker->numberBetween(2000, 2025),
            'price' => $this->faker->numberBetween(10000, 50000),
            'mileage' => $this->faker->numberBetween(10000, 100000),
            'condition' => $this->faker->randomElement(['new', 'used']),
            'brand_id' => 4, // Assuming 1-10 brand IDs exist in the database
            'category_id' => 1, // Assuming 1-5 category IDs exist in the database
            // Add other fields and their default values as needed...
        ];
    }
}
