<?php

namespace Tests\Feature;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class UpdateCompanyTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * A basic feature test example.
     */
    public function test_update_company()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $company = Company::factory()->create();

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

        // Attempt to update the company
        $response = $this->putJson("/api/companies/{$company->id}", $data);

        // Assert that the update should fail with a 403 Forbidden status
        $response->assertStatus(403);
    }
}
