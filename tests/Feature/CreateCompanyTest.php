<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class CreateCompanyTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_create_company(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $data = [
            'owner_id' => $user->id,
            'name' => 'Test Company',
            'logo' => UploadedFile::fake()->create('company_logo.jpg'),
            'address' => '123 Test St',
            'mobile_number' => '1234567890',
            'email' => 'test@example.com',
            'website' => 'http://example.com',
            'description' => 'This is a test company',
        ];

        $response = $this->postJson('/api/companies/', $data);

        $response->assertStatus(201)
            ->assertJson([
                'message' => 'Company created successfully',

            ]);
    }
}
