<?php

namespace Tests\Feature;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PurchaseControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected $vendor;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'user_type' => 'admin',
        ]);

        $this->vendor = User::factory()->create([
            'user_type' => 'vendor',
            'owner_id' => $this->user->id,
        ]);

        $this->actingAs($this->user);
    }

    public function test_index_displays_purchases()
    {
        Purchase::factory()->count(3)->create([
            'owner_id' => $this->user->id,
        ]);

        $response = $this->get('/purchase');

        $response->assertStatus(200)
            ->assertViewIs('pages.purchase')
            ->assertViewHas('purchases');
    }

    public function test_create_displays_form()
    {
        $response = $this->get('/purchase/create');

        $response->assertStatus(200)
            ->assertViewIs('pages.create-purchase')
            ->assertViewHas(['vendors', 'raw', 'count']);
    }

    public function test_store_creates_new_purchase()
    {
        $purchaseData = [
            'raw_id' => 1,
            'user_id' => $this->vendor->id,
            'qty' => 100,
            'price' => 50,
            'sale_price' => 75,
            'total' => 5000,
            'name' => 'Add New Purchase_test',
            'action' => 'add',
        ];

        $response = $this->post('/purchase', $purchaseData);

        $response->assertRedirect('/purchase')
            ->assertSessionHas('success', 'Purchase add successfully.');

        $this->assertDatabaseHas('purchases', [
            'user_id' => $this->vendor->id,
            'qty' => 100,
            'price' => 50,
            'sale_price' => 75,
            'total' => 5000,
        ]);

        $this->assertDatabaseHas('purchase_histories', [
            'user_id' => $this->vendor->id,
            'qty' => 100,
            'price' => 50,
        ]);
    }

    public function test_store_updates_existing_purchase()
    {
        Purchase::factory()->create([
            'owner_id' => $this->user->id,
            'qty' => 0,
            'price' => 0,
            'sale_price' => 0,
            'name' => 'Add New Purchase',
        ]);
        $existingPurchase = Purchase::factory()->create([
            'owner_id' => $this->user->id,
            'qty' => 50,
            'price' => 100,
            'sale_price' => 150,
            'name' => 'Add New Purchase_test_update',
        ]);

        $updateData = [
            'raw_id' => $existingPurchase->id,
            'user_id' => $this->vendor->id,
            'qty' => 25,
            'price' => 120,
            'sale_price' => 180,
            'total' => 3000,
            'action' => 'update',
            'owner_id' => $this->user->id,
            'name' => null,
        ];

        // dd($updateData);
        $response = $this->post('/purchase', $updateData);

        $response->assertRedirect('/purchase')
            ->assertSessionHas('success', 'Purchase update successfully.');

        $existingPurchase->refresh();

        $this->assertEquals(75, $existingPurchase->qty); // 50 + 25
        $this->assertEquals(120, $existingPurchase->price);
        $this->assertEquals(180, $existingPurchase->sale_price);
    }

    public function test_edit_displays_form()
    {
        $purchase = Purchase::factory()->create([
            'owner_id' => $this->user->id,
        ]);

        $response = $this->get("/purchase/{$purchase->id}/edit");

        $response->assertStatus(200)
            ->assertViewIs('pages.edit-purchase')
            ->assertViewHas(['vendors', 'purchase', 'raw', 'count']);
    }

    public function test_update_modifies_purchase()
    {
        Purchase::factory()->create([
            'owner_id' => $this->user->id,
            'qty' => 0,
            'price' => 0,
            'total' => 0,
        ]);
        $purchase = Purchase::factory()->create([
            'owner_id' => $this->user->id,
            'qty' => 100,
            'price' => 50,
            'total' => 5000,
        ]);
        $updateData = [
            'user_id' => $this->vendor->id,
            'qty' => 80,
            'price' => 60,
            'sale_price' => 90,
            'total' => 4800,
            'owner_id' => $this->user->id,
        ];

        $response = $this->put("/purchase/{$purchase->id}", $updateData);

        $response->assertRedirect("/purchase/{$purchase->id}/edit")
            ->assertSessionHas('success', 'Purchase updated successfully.');

        $this->assertDatabaseHas('purchases', [
            'id' => $purchase->id,
            'qty' => 80,
            'price' => 60,
            'sale_price' => 90,
        ]);

        // Verify purchase history was created
        $this->assertDatabaseHas('purchase_histories', [
            'qty' => 20, // difference between old and new qty
            'price' => 60,
            'total' => -1200, // negative difference * new price
        ]);
    }

    public function test_unauthorized_access_redirects_to_login()
    {
        auth()->logout();

        $response = $this->get('/purchase');

        $response->assertRedirect('/login');
    }

    public function test_non_admin_cannot_access_purchases()
    {
        $nonAdmin = User::factory()->create([
            'user_type' => 'customer',
        ]);

        $this->actingAs($nonAdmin);

        $response = $this->get('/purchase');

        $response->assertStatus(403);
    }

    public function test_validates_sale_price_greater_than_purchase_price()
    {
        $purchaseData = [
            'raw_id' => 1,
            'user_id' => $this->vendor->id,
            'qty' => 100,
            'price' => 50,
            'sale_price' => 40, // Less than purchase price
            'total' => 5000,
            'action' => 'add',
        ];

        $response = $this->post('/purchase', $purchaseData);

        $response->assertSessionHasErrors('sale_price');
    }
}
