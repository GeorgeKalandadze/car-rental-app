<?php

namespace Database\Factories;

use App\Enums\FuelType;
use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
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
    protected function generateVinCode(): string
    {
        return $this->faker->randomLetter . $this->faker->randomLetter . $this->faker->randomDigit . $this->faker->randomDigit . $this->faker->randomLetter . $this->faker->randomLetter . $this->faker->randomDigit . $this->faker->randomDigit . $this->faker->randomLetter . $this->faker->randomLetter . $this->faker->randomDigit . $this->faker->randomDigit . $this->faker->randomLetter . $this->faker->randomLetter . $this->faker->randomDigit . $this->faker->randomDigit;
    }



    public function definition(): array
    {
        $user = User::factory()->create();

        $brand = Brand::inRandomOrder()->first();

        $model = $brand->carModels()->inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'model_id' => $model->id,
            'year' => $this->faker->numberBetween(2000, 2025),
            'price' => $this->faker->numberBetween(10000, 50000),
            'mileage' => $this->faker->numberBetween(10000, 100000),
            'condition' => $this->faker->randomElement(['new', 'used']),
            'brand_id' => $brand->id,
            'category_id' => 1,
            'vin' => $this->generateVinCode(),
            'fuel_type' => $this->faker->randomElement(FuelType::toArray())
        ];


    }
}
