<?php

namespace Tests\Feature\Api;

use App\Enums\FuelType;
use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateCarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_create_car_with_images(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);
        $imageFiles = [];
        for ($i = 0; $i < 4; $i++) {
            $extension = 'jpg';
            $image = UploadedFile::fake()->create("car_image{$i}.{$extension}");
            $imageFiles[] = $image;
        }

        $vinCode = 'ABC12345';

        $carData = [
            'user_id' => $user->id,
            'model_id' => 1,
            'year' => '2023',
            'price' => '25000',
            'mileage' => '20000',
            'condition' => 'new',
            'brand_id' => 1,
            'category_id' => 2,
            'vin' => $vinCode,
            'fuel_type' => FuelType::toArray()[array_rand(FuelType::toArray())],
//            'images' => $imageFiles,
        ];

        $response = $this->postJson('/api/cars/create', $carData);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' => [
                'id',
                'model_id',
                'year',
                'price',
                'mileage',
                'condition',
                'brand_id',
                'category_id',
                'vin_code',
                'fuel_type',
//                'car_images' => [
//                    '*' => [
//                        'id',
//                        'car_id',
//                        'url',
//                        'size',
//                        'type',
//                    ],
//                ],
            ]]);
    }
}
