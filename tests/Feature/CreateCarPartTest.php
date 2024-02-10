<?php

namespace Tests\Feature;


use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateCarPartTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_create_car_part(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $imageFiles = [];
        for ($i = 0; $i < 4; $i++) {
            $extension = 'jpg';
            $image = UploadedFile::fake()->create("car_part_image{$i}.{$extension}");
            $imageFiles[] = $image;
        }

        $data = [
            'user_id' => $user->id,
            'name' => 'testName',
            'price' => '250',
            'condition' => 'new',
            'brand_id' => 1,
            'category_id' => 2,
            'model_id' => 1,
            'images' => $imageFiles,
        ];

        $response = $this->postJson('/api/car-parts/create', $data);
        $response->assertStatus(201)
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
