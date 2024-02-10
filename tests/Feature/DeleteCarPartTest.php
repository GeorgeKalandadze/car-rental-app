<?php

namespace Tests\Feature;

use App\Models\CarPart;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteCarPartTest extends TestCase
{
    use DatabaseTransactions;
    /**
     * A basic feature test example.
     */
    public function test_car_part(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $carPart= CarPart::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/car-parts/{$carPart->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Car part deleted successfully']);
    }
}
