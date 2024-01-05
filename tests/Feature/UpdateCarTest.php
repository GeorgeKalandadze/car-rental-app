<?php

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateCarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_update_car_with_images(): void
    {
        // Create a user and authenticate
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // Create a car for updating
        $car = Car::factory()->create();

        // Prepare updated data (assuming only 'make', 'model', 'year', 'images' are updatable fields)
        $updatedData = [
            'make' => 'Updated Make',
            'model' => 'Updated Model',
            'year' => '2024',
            'price' => 25000, // Set the price
            'mileage' => 50000, // Set the mileage
            'condition' => 'used', // Set the condition
            'brand_id' => 1, // Set the brand ID
            'category_id' => 1, // Set the category ID
        ];

        // Simulate file upload for updated images
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
                'make',
                'model',
                'year',
                'car_images' => [
                    '*' => [
                        'id',
                        'car_id',
                        'url',
                        'size',
                        'type',

                    ]
                ]
            ]]);
    }
}
