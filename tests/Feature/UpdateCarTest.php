<?php

use App\Enums\FuelType;
use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateCarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_update_car_with_images(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $car = Car::factory()->create();
        $vinCode = 'ABC'.uniqid();
        $updatedData = [
            'model_id' => 2,
            'year' => '2024',
            'price' => 25000,
            'mileage' => 50000,
            'condition' => 'used',
            'brand_id' => 1,
            'category_id' => 1,
            'vin' => $vinCode,
            'fuel_type' => FuelType::toArray()[array_rand(FuelType::toArray())],
        ];

        $imageFiles = [];
        for ($i = 0; $i < 3; $i++) {
            $extension = 'jpg';
            $image = UploadedFile::fake()->create("updated_car_image{$i}.{$extension}");
            $imageFiles[] = $image;
        }
        $updatedData['images'] = $imageFiles;

        $response = $this->putJson("/api/cars/{$car->id}", $updatedData);

        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [
                'id',
                'model_id',
                'year',
                'car_images' => [
                    '*' => [
                        'id',
                        'car_id',
                        'url',
                        'size',
                        'type',
                    ],
                ],
            ]]);
    }
}
