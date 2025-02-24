<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class VendorControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $this->admin = User::factory()->create([
            'user_type' => 'admin',
            'email_verified_at' => now(),
        ]);

        $this->actingAs($this->admin);
    }

    public function test_store_creates_new_vendor()
    {
        $vendorData = [
            'first_name' => 'Test Vendor',
            'last_name' => 'Test Vendor',
            'email' => 'vendor@test.com',
            'phone' => '1234567890',
            'user_type' => 'vendor',
            'owner_id' => $this->admin->id,
            'password' => 'password123',
        ];

        $response = $this->postJson('/vendor', $vendorData);

        $response->assertStatus(200)
            ->assertJson([
                'message' => 'Successfully created',
                'error' => true,
            ])
            ->assertJsonStructure([
                'message',
                'error',
                'data',
            ]);

        $this->assertDatabaseHas('users', [
            // 'name' => 'Test Vendor',
            'email' => 'vendor@test.com',
            'phone' => '1234567890',
            'user_type' => 'vendor',
            'owner_id' => $this->admin->id,
        ]);
    }

    public function test_store_validates_required_fields()
    {
        $response = $this->postJson('/vendor', []);

        $response->assertStatus(422)
            ->assertJsonValidationErrors([
                'first_name',
                'last_name',
                'phone',
            ]);
    }

    public function test_store_validates_unique_email()
    {
        $existingVendor = User::factory()->create([
            'email' => 'existing@vendor.com',
            'user_type' => 'vendor',
        ]);

        $vendorData = [
            'first_name' => 'Test Vendor',
            'last_name' => 'Test Vendor',
            'email' => 'existing@vendor.com',
            'phone' => '1234567890',
            'user_type' => 'vendor',
            'owner_id' => $this->admin->id,
            'password' => 'password123',
        ];

        $response = $this->postJson('/vendor', $vendorData);

        $response->assertStatus(422);
    }

    public function test_unauthorized_access_redirects_to_login()
    {
        auth()->logout();

        $response = $this->postJson('/vendor', []);

        $response->assertStatus(401);
    }

    public function test_non_admin_cannot_create_vendor()
    {
        $nonAdmin = User::factory()->create([
            'user_type' => 'customer',
        ]);

        $this->actingAs($nonAdmin);

        $vendorData = [
            'first_name' => 'Test Vendor',
            'last_name' => 'Test Vendor',
            'email' => 'vendor@test.com',
            'phone' => '1234567890',
            'user_type' => 'vendor',
            'owner_id' => $nonAdmin->id,
            'password' => 'password123',
        ];

        $response = $this->postJson('/vendor', $vendorData);

        $response->assertStatus(403);
    }

    public function test_store_validates_email_format()
    {
        $vendorData = [
            'first_name' => 'Test Vendor',
            'last_name' => 'Test Vendor',
            'email' => 'invalid-email',
            'phone' => '1234567890',
            'user_type' => 'vendor',
            'owner_id' => $this->admin->id,
            'password' => 'password123',
        ];

        $response = $this->postJson('/vendor', $vendorData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['email']);
    }

    public function test_store_validates_phone_format()
    {
        $vendorData = [
            'first_name' => 'Test Vendor',
            'last_name' => 'Test Vendor',
            'email' => 'vendor@test.com',
            'phone' => '',
            'user_type' => 'vendor',
            'owner_id' => $this->admin->id,
            'password' => 'password123',
        ];

        $response = $this->postJson('/vendor', $vendorData);

        $response->assertStatus(422)
            ->assertJsonValidationErrors(['phone']);
    }

    public function test_store_sets_correct_user_type()
    {
        $vendorData = [
            'first_name' => 'Test Vendor',
            'last_name' => 'Test Vendor',
            'email' => 'vendor@test.com',
            'phone' => '1234567890',
            'user_type' => 'admin', // Trying to create an admin
            'owner_id' => $this->admin->id,
            'password' => 'password123',
        ];

        $response = $this->postJson('/vendor', $vendorData);

        $response->assertStatus(200);

        // Verify the user_type is forced to 'vendor' regardless of input
        $this->assertDatabaseHas('users', [
            'email' => 'vendor@test.com',
            'user_type' => 'vendor',
        ]);
    }
}
