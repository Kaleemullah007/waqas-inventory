<?php

namespace Tests\Feature;

use App\Models\Expense;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExpenseControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'status' => true,
            'per_page' => 10,
        ]);

        $this->actingAs($this->user);
    }

    public function test_index_displays_expenses_list()
    {
        // Create test expenses
        $expenses = Expense::factory()->count(3)->create([
            'name' => 'Test Expense',
            'amount' => 1000,
        ]);

        $response = $this->get('/expense');

        $response->assertStatus(200)
            ->assertViewIs('pages.expense')
            ->assertViewHas('expenses');
    }

    public function test_index_redirects_to_last_page_when_page_exceeds_max()
    {
        // Create expenses that exceed one page
        Expense::factory()->count(15)->create();

        // Request a page that exceeds the last page
        $response = $this->get('/expense?page=999');

        $response->assertRedirect();
        $response->assertSessionDoesntHaveErrors();
    }

    public function test_get_expenses_returns_filtered_results()
    {
        $expense1 = Expense::factory()->create([
            'name' => 'Office Supplies',
            'date' => '2023-01-01',
        ]);

        $expense2 = Expense::factory()->create([
            'name' => 'Utilities',
            'date' => '2023-02-01',
        ]);

        $response = $this->postJson('/get-expenses', [
            'search' => 'Office',
            'daterange' => '01/01/2023-01/31/2023',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['html', 'phtml']);

        $responseData = $response->json();
        $this->assertTrue(str_contains($responseData['html'], 'Office Supplies'));
        $this->assertFalse(str_contains($responseData['html'], 'Utilities'));
    }

    public function test_create_displays_create_form()
    {
        $response = $this->get('/expense/create');

        $response->assertStatus(200)
            ->assertViewIs('pages.create-expense');
    }

    public function test_store_creates_new_expense()
    {
        $expenseData = [
            'name' => 'New Expense',
            'amount' => 1500,
            'date' => now()->format('Y-m-d'),
            'description' => 'Test expense description',
        ];

        $response = $this->post('/expense', $expenseData);

        $response->assertRedirect('/expense/create')
            ->assertSessionHas('success', 'Expense created successfully.');

        $this->assertDatabaseHas('expenses', [
            'name' => 'New Expense',
            'amount' => 1500,
        ]);
    }

    public function test_edit_shows_edit_form()
    {
        $expense = Expense::factory()->create();

        $response = $this->get("/expense/{$expense->id}/edit");

        $response->assertStatus(200)
            ->assertViewIs('pages.edit-expense')
            ->assertViewHas('expense');

        $viewExpense = $response->viewData('expense');
        $this->assertEquals($expense->id, $viewExpense->id);
    }

    public function test_update_modifies_expense()
    {
        $expense = Expense::factory()->create([
            'name' => 'Original Name',
            'amount' => 1000,
        ]);

        $updatedData = [
            'name' => 'Updated Name',
            'amount' => 2000,
            'date' => now()->format('Y-m-d'),
            'description' => 'Updated description',
        ];

        $response = $this->put("/expense/{$expense->id}", $updatedData);

        $response->assertRedirect("/expense/{$expense->id}/edit")
            ->assertSessionHas('success', 'Expense updated successfully.');

        $this->assertDatabaseHas('expenses', [
            'id' => $expense->id,
            'name' => 'Updated Name',
            'amount' => 2000,
        ]);
    }

    public function test_store_validates_required_fields()
    {
        $response = $this->post('/expense', []);

        $response->assertSessionHasErrors(['name', 'amount', 'date']);
    }

    public function test_update_validates_required_fields()
    {
        $expense = Expense::factory()->create();

        $response = $this->put("/expense/{$expense->id}", []);

        $response->assertSessionHasErrors(['name', 'amount', 'date']);
    }

    public function test_unauthorized_access_redirects_to_login()
    {
        auth()->logout();

        $response = $this->get('/expense');

        $response->assertRedirect('/login');
    }
}
