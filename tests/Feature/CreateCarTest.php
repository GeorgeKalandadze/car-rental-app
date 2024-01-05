<?php

namespace Tests\Feature\Api;

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

        $carData = [
            'make' => 'Test Make',
            'model' => 'Test Model',
            'year' => '2023',
            'price' => '25000',
            'mileage' => '20000',
            'condition' => 'new',
            'brand_id' => 2,
            'category_id' => 2,
            'images' => $imageFiles,
        ];

        $response = $this->postJson('/api/car', $carData);

        $response->assertStatus(201)
            ->assertJsonStructure(['data' =>[
                'id',
                'make',
                'model',
                'year',
                'price',
                'mileage',
                'condition',
                'brand_id',
                'category_id',
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
