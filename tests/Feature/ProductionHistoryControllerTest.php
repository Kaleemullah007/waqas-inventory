<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\ProductionHistory;
use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductionHistoryControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected $product;

    protected $purchase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'user_type' => 'admin',
            'status' => true,
            'per_page' => 10,
        ]);

        $this->product = Product::factory()->create(

        );
        $this->purchase = Purchase::factory()->create(
            [
                'qty' => 100,
                'name' => 'Add New Purchase_test',
                'user_id' => $this->user->id,
                'price' => 100,
                'sale_price' => 100,
                'total' => 10000,
                'owner_id' => $this->user->id,
            ]
        );

        $this->actingAs($this->user);
    }

    public function test_index_displays_production_history()
    {
        ProductionHistory::factory()->count(3)->create();

        $response = $this->get('/production');

        $response->assertStatus(200)
            ->assertViewIs('pages.production')
            ->assertViewHas('productions');
    }

    public function test_index_redirects_to_last_page_when_page_exceeds_max()
    {
        ProductionHistory::factory()->count(15)->create();

        $response = $this->get('/production?page=999');

        $response->assertRedirect();
    }

    public function test_get_production_returns_filtered_results()
    {
        $production1 = ProductionHistory::factory()->create([
            'created_at' => now()->subDays(5),
        ]);

        $production2 = ProductionHistory::factory()->create([
            'created_at' => now()->subDays(10),
        ]);

        $response = $this->post('/get-productions', [
            'daterange' => now()->subDays(7)->format('m/d/Y').'-'.now()->format('m/d/Y'),
            'search' => '',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['html', 'phtml']);

        $responseData = $response->json();
        $this->assertNotEmpty($responseData['html']);
    }

    public function test_create_displays_form()
    {
        $response = $this->get('/production/create');

        $response->assertStatus(200)
            ->assertViewIs('pages.create-production')
            ->assertViewHas(['products', 'raws']);
    }

    public function test_store_creates_new_production()
    {
        $productionData = [
            'product_id' => $this->product->id,
            'purchase_id' => $this->purchase->id,
            'qty' => 50,
            'wastage_qty' => 10,
            'owner_id' => $this->user->id,
        ];

        $response = $this->post('/production', $productionData);

        $response->assertRedirect('/production')
            ->assertSessionHas('success', 'Production created successfully.');

        $this->assertDatabaseHas('production_histories', [
            'product_id' => $this->product->id,
            'qty' => 50,
            'wastage_qty' => 10,
            'purchase_id' => $this->purchase->id,
        ]);

        // Check if product stock was incremented
        $this->product->refresh();
        $this->assertEquals(50, $this->product->stock);

        // Check if purchase quantity was decremented
        $this->purchase->refresh();
        $this->assertEquals(40, $this->purchase->qty); // 100 - (50 + 10)
    }

    public function test_store_validates_production_against_purchase_stock()
    {
        $productionData = [
            'product_id' => $this->product->id,
            'purchase_id' => $this->purchase->id,
            'qty' => 90,
            'wastage_qty' => 20, // Total 110, exceeds purchase qty of 100
            'description' => 'Test production',
        ];

        $response = $this->post('/production', $productionData);

        $response->assertRedirect('/production/create')
            ->assertSessionHas('warning', 'Production can not be greater than Purchased Stock');
    }

    public function test_edit_shows_edit_form()
    {
        $production = ProductionHistory::factory()->create();

        $response = $this->get("/production/{$production->id}/edit");

        $response->assertStatus(200)
            ->assertViewIs('pages.edit-production')
            ->assertViewHas(['production', 'products', 'raws']);
    }

    public function test_update_modifies_production()
    {
        $production = ProductionHistory::factory()->create([
            'product_id' => $this->product->id,
            'purchase_id' => $this->purchase->id,
            'qty' => 30,
            'wastage_qty' => 10,
        ]);

        $updatedData = [
            'product_id' => $this->product->id,
            'purchase_id' => $this->purchase->id,
            'qty' => 40,
            'wastage_qty' => 15,
            'description' => 'Updated production',
        ];

        $response = $this->put("/production/{$production->id}", $updatedData);

        $response->assertRedirect("/production/{$production->id}/edit")
            ->assertSessionHas('success', 'Production updated successfully.');

        $this->assertDatabaseHas('production_histories', [
            'id' => $production->id,
            'qty' => 40,
            'wastage_qty' => 15,
        ]);
    }

    public function test_update_validates_against_purchase_stock()
    {
        $production = ProductionHistory::factory()->create([
            'product_id' => $this->product->id,
            'purchase_id' => $this->purchase->id,
            'qty' => 30,
            'wastage_qty' => 10,
            'owner_id' => $this->user->id,
        ]);

        $updatedData = [
            'product_id' => $this->product->id,
            'purchase_id' => $this->purchase->id,
            'qty' => 190,
            'wastage_qty' => 20, // Total exceeds available stock
            'owner_id' => $this->user->id,
        ];

        $response = $this->put("/production/{$production->id}", $updatedData);

        $response->assertRedirect()
            ->assertSessionHas('warning', 'Production can not be greater than Purchased Stock');
    }

    public function test_unauthorized_access_redirects_to_login()
    {
        auth()->logout();

        $response = $this->get('/production');

        $response->assertRedirect('/login');
    }

    public function test_requires_verified_email()
    {
        $unverifiedUser = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $this->actingAs($unverifiedUser);

        $response = $this->get('/production');

        $response->assertRedirect('/email/verify');
    }
}
