<?php

use App\Models\Car;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class DeleteCarTest extends TestCase
{
    use DatabaseTransactions;

    public function test_delete_car_as_owner(): void
    {
        // Create a user
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        // Create a car for the user
        $car = Car::factory()->create(['user_id' => $user->id]);

        $response = $this->deleteJson("/api/cars/{$car->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Car deleted successfully']);
    }

    public function test_delete_car_as_non_owner(): void
    {
        // Create two different users
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        Sanctum::actingAs($user2); // Acting as the second user

        // Create a car for user1
        $car = Car::factory()->create(['user_id' => $user1->id]);

        $response = $this->deleteJson("/api/cars/{$car->id}");

        $response->assertStatus(403)
            ->assertJson(['error' => 'You are not authorized to delete this car.']);
    }

}
