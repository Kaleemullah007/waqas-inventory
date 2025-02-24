<?php

namespace Tests\Feature;

use App\Models\Customer;
use App\Models\DepositHistory;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DepositHistoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected $customer;

    protected function setUp(): void
    {
        parent::setUp();

        // Create authenticated user
        $this->user = User::factory()->create([
            'user_type' => 'admin',
            'is_factory_user' => 1,
        ]);

        // Create a test customer
        $this->customer = Customer::factory()->create([
            'user_type' => 'customer',
            'owner_id' => $this->user->id,
            'status' => true,
        ]);

        $this->actingAs($this->user);
    }

    public function test_index_returns_deposit_history()
    {
        // Create some deposit history records
        $deposits = DepositHistory::factory()->count(3)->create([
            'user_id' => $this->customer->id,
            'amount' => 1000,
        ]);

        // Make request without user_id filter
        $response = $this->get('/deposit-html');

        $response->assertStatus(200)
            ->assertJsonStructure(['html']);

        // Verify response contains deposit information
        $responseData = $response->json();
        $this->assertNotEmpty($responseData['html']);
        $this->assertTrue(
            str_contains($responseData['html'], (string) $deposits[0]->amount)
        );
    }

    public function test_index_filters_by_user_id()
    {
        // Create deposits for different customers
        $deposit1 = DepositHistory::factory()->create([
            'user_id' => $this->customer->id,
            'amount' => 1000,
        ]);

        $otherCustomer = Customer::factory()->create([
            'user_type' => 'customer',
        ]);

        $deposit2 = DepositHistory::factory()->create([
            'user_id' => $otherCustomer->id,
            'amount' => 2000,
        ]);

        // Make request with user_id filter
        $response = $this->get("/deposit-html?user_id={$this->customer->id}");

        $response->assertStatus(200);

        // Verify filtered results
        $responseData = $response->json();
        $this->assertTrue(str_contains($responseData['html'], (string) $deposit1->amount));
        $this->assertFalse(str_contains($responseData['html'], (string) $deposit2->amount));
    }

    public function test_store_creates_new_deposit()
    {
        $depositData = [
            'user_id' => $this->customer->id,
            'amount' => 1500,
            'date' => now()->format('Y-m-d'),
            'description' => 'Test deposit',
        ];

        $response = $this->post('/deposit', $depositData);

        $response->assertRedirect()
            ->assertSessionHas('success', 'Deposit added successfully.');

        $this->assertDatabaseHas('deposit_histories', [
            'user_id' => $this->customer->id,
            'amount' => 1500,
        ]);
    }

    public function test_edit_shows_edit_form()
    {
        $deposit = DepositHistory::factory()->create([
            'user_id' => $this->customer->id,
            'amount' => 1000,
        ]);

        $response = $this->get("/deposit/{$deposit->id}/edit");

        $response->assertStatus(200)
            ->assertViewIs('pages.edit-deposit')
            ->assertViewHas('deposit')
            ->assertViewHas('customers');

        // Verify the correct deposit is passed to the view
        $viewDeposit = $response->viewData('deposit');
        $this->assertEquals($deposit->id, $viewDeposit->id);
    }

    public function test_update_modifies_deposit()
    {
        $deposit = DepositHistory::factory()->create([
            'user_id' => $this->customer->id,
            'amount' => 1000,
        ]);

        $updatedData = [
            'user_id' => $this->customer->id,
            'amount' => 2000,
            'date' => now()->format('Y-m-d'),
            'description' => 'Updated deposit',
        ];

        $response = $this->put("/deposit/{$deposit->id}", $updatedData);

        $response->assertRedirect()
            ->assertSessionHas('success', 'Deposit Amount updated successfully.');

        $this->assertDatabaseHas('deposit_histories', [
            'id' => $deposit->id,
            'amount' => 2000,
            'description' => 'Updated deposit',
        ]);
    }

    public function test_store_validates_required_fields()
    {
        $response = $this->post('/deposit', []);

        $response->assertSessionHasErrors(['user_id', 'amount']);
    }

    public function test_update_validates_required_fields()
    {
        $deposit = DepositHistory::factory()->create([
            'user_id' => $this->customer->id,
            'amount' => 1000,
        ]);

        $response = $this->put("/deposit/{$deposit->id}", []);

        $response->assertSessionHasErrors(['user_id', 'amount']);
    }

    public function test_unauthorized_access_redirects_to_login()
    {
        auth()->logout();

        $response = $this->get('/deposit-html');
        $response->assertRedirect('/login');
    }
}
