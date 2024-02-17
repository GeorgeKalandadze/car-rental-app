<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCompanyTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function test_delete_company()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create(['owner_id' => $user->id]);

        $response = $this->deleteJson("/api/companies/{$company->id}");

        $response->assertStatus(200)
            ->assertJson(['message' => 'Company deleted successfully']);

    }
}
