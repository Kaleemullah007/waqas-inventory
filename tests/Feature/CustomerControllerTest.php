<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\DepositHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    private $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create and authenticate a user
        $this->user = User::factory()->create([
            'status' => true,
        ]);
        $this->actingAs($this->user);
    }

    public function test_index_displays_customers_list()
    {
        // Create some test customers
        $customers = Customer::factory()->count(3)->create([
            'user_type' => 'customer',
        ]);

        $response = $this->get('/customer');

        $response->assertStatus(200);
        $response->assertViewIs('pages.customer');
        $response->assertViewHas('customers');
    }

    public function test_index_redirects_to_last_page_when_page_exceeds_max()
    {
        // Create customers that exceed one page
        $customers = Customer::factory()->count(15)->create([
            'user_type' => 'customer',
        ]);

        // Request a page that exceeds the last page
        $response = $this->get('/customer?page=999');

        $response->assertRedirect();
        $response->assertSessionDoesntHaveErrors();
    }

    public function test_create_displays_create_form()
    {
        $response = $this->get('/customer/create');

        $response->assertStatus(200);
        $response->assertViewIs('pages.create-customer');
    }

    public function test_store_creates_new_customer()
    {
        $customerData = [
            'first_name' => 'Test Customer',
            'last_name' => 'Test Customer',
            'email' => 'test@customer.com',
            'phone' => '1234567890',
            'user_type' => 'customer',
            'owner_id' => $this->user->id,
            'password' => 'password123',
        ];

        $response = $this->post('/customer', $customerData);

        $response->assertRedirect('/customer');
        $response->assertSessionHas('success', 'Customer created successfully.');

        $this->assertDatabaseHas('users', [
            // 'name' => 'Test Customer',
            'email' => 'test@customer.com',
            'phone' => '1234567890',
            'user_type' => 'customer',
        ]);
    }

    public function test_store_customer_via_ajax()
    {
        $customerData = [
            'first_name' => 'Test Customer',
            'last_name' => 'Test Customer',
            'email' => 'ajax@customer.com',
            'phone' => '1234567890',
        ];

        $response = $this->withHeaders([
            'X-Requested-With' => 'XMLHttpRequest',
            'Accept' => 'application/json',
        ])->post('/customer', $customerData);

        $response->assertStatus(200);
        $this->assertDatabaseHas('users', [
            'email' => 'ajax@customer.com',
            'phone' => '1234567890',
            'user_type' => 'customer',
        ]);

        $response->assertJsonStructure([
            'message',
            'error',
        ]);
    }

    public function test_edit_displays_edit_form()
    {
        $customer = Customer::factory()->create([
            'user_type' => 'customer',
            'status' => true,
            'owner_id' => 1,
        ]);

        $response = $this->get("/customer/{$customer->id}/edit");
        $response->assertStatus(200);
        $response->assertViewIs('pages.edit-customer');
        $response->assertViewHas('customer');

    }

    public function test_update_modifies_customer()
    {
        $customer = Customer::factory()->create([
            'user_type' => 'customer',
            'status' => true,
            'owner_id' => 1,
        ]);

        $updatedData = [
            'first_name' => 'Updated',
            'last_name' => 'Customer',
            'email' => 'updated@customer.com',
            'phone' => '9876543210',
            'user_type' => 'customer',
            'page' => 1,
        ];

        $response = $this->put("/customer/{$customer->id}", $updatedData);

        $response->assertRedirect('/customer?page=1');
        $response->assertSessionHas('success', 'Customer updated successfully.');

        $this->assertDatabaseHas('users', [
            'id' => $customer->id,
            'name' => 'Updated Customer',
            'email' => 'updated@customer.com',
            'phone' => '9876543210',
        ]);
    }

    public function test_get_customers_returns_json_response()
    {
        // Create test customers
        $customers = Customer::factory()->count(3)->create([
            'user_type' => 'customer',
            'owner_id' => $this->user->id,
            'status' => true,
        ]);

        // Create some deposit history for a customer
        DepositHistory::factory()->create([
            'user_id' => $customers[0]->id,
            'amount' => 1000,
        ]);

        // Make POST request with search parameters
        $response = $this->postJson('/get-customers', [
            'search' => '',
            'page' => 1,
        ]);

        // Assert response structure and status
        $response->assertStatus(200)
            ->assertJsonStructure([
                'html',
                'phtml',
            ]);

        // Assert response contains customer data
        $responseData = $response->json();
        $this->assertNotEmpty($responseData['html']);

        // Verify customer information is present in the response
        $this->assertTrue(
            str_contains($responseData['html'], $customers[0]->name) &&
            str_contains($responseData['html'], $customers[0]->email)
        );

        // Verify pagination HTML exists
        $this->assertNotEmpty($responseData['phtml']);
    }

    public function test_unauthorized_access_redirects_to_login()
    {
        auth()->logout();

        $response = $this->get('/customer');

        $response->assertRedirect('/login');
    }
}
