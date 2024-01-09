<?php

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ToggleFavoriteCarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_toggle_favorite_car(): void
    {
        // Create a user
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // Create a car for that user
        $car = Car::factory()->create(['user_id' => $user->id]);

        // Get initial favorite status
        $initialFavoriteStatus = $user->favoriteCars()->where('car_id', $car->id)->exists();

        // Toggle favorite status
        $response = $this->postJson("/api/cars/{$car->id}/toggle-favorite");

        // Check if the favorite status changed after toggling
        $newFavoriteStatus = $user->fresh()->favoriteCars()->where('car_id', $car->id)->exists();

        $response->assertStatus(201);

        $this->assertNotEquals($initialFavoriteStatus, $newFavoriteStatus, 'Favorite status should change after toggling');
    }
}
