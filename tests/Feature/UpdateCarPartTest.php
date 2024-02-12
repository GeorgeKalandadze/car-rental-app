<?php

namespace Tests\Feature;

use App\Models\CarPart;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class UpdateCarPartTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_update_car_part(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $carPart = CarPart::factory()->create();

        $updatedData = [
            'user_id' => $user->id,
            'name' => 'testName',
            'price' => '450',
            'condition' => 'new',
            'brand_id' => 3,
            'category_id' => 2,
            'model_id' => 1,

        ];

        $imageFiles = [];
        for ($i = 0; $i < 3; $i++) {
            $extension = 'jpg';
            $image = UploadedFile::fake()->create("updated_car_image{$i}.{$extension}");
            $imageFiles[] = $image;
        }
        $updatedData['images'] = $imageFiles;

        $response = $this->putJson("/api/car-parts/$carPart->id}", $updatedData);
        $response->assertStatus(200)
            ->assertJsonStructure(['data' => [
                'part_id',
                'part_name',
                'part_condition',
                'brand',
                'model',
                'user',
                'category',
                'part_images' => [
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
