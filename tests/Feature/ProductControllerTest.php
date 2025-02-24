<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'user_type' => 'admin',
            'status' => true,
            'per_page' => 10,
        ]);

        $this->actingAs($this->user);
    }

    public function test_index_displays_products_list()
    {
        // Create test products
        $products = Product::factory()->count(3)->create();

        $response = $this->get('/product');

        $response->assertStatus(200)
            ->assertViewIs('pages.product')
            ->assertViewHas('products');
    }

    public function test_index_redirects_to_last_page_when_page_exceeds_max()
    {
        // Create products that exceed one page
        Product::factory()->count(15)->create();

        // Request a page that exceeds the last page
        $response = $this->get('/product?page=999');

        $response->assertRedirect();
    }

    public function test_get_products_returns_filtered_results()
    {
        $product1 = Product::factory()->create([
            'name' => 'Test Product One',
        ]);

        $product2 = Product::factory()->create([
            'name' => 'Different Product',
        ]);

        $response = $this->postJson('/get-products', [
            'search' => 'Test',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['html', 'phtml']);

        $responseData = $response->json();
        $this->assertTrue(str_contains($responseData['html'], 'Test Product One'));
        $this->assertFalse(str_contains($responseData['html'], 'Different Product'));
    }

    public function test_create_displays_create_form()
    {
        $response = $this->get('/product/create');

        $response->assertStatus(200)
            ->assertViewIs('pages.create-product');
    }

    public function test_store_creates_new_product()
    {
        $productData = [
            'name' => 'New Product',
            'sale_price' => 100,
            'price' => 100,
            'stock' => 50,
            'stock_alert' => 10,
        ];

        $response = $this->post('/product', $productData);

        $response->assertRedirect('/product')
            ->assertSessionHas('success', 'Product created successfully.');

        $this->assertDatabaseHas('products', [
            'name' => 'New Product',
            'sale_price' => 100,
        ]);
    }

    public function test_edit_shows_edit_form()
    {
        $product = Product::factory()->create();

        $response = $this->get("/product/{$product->id}/edit");

        $response->assertStatus(200)
            ->assertViewIs('pages.edit-product')
            ->assertViewHas('product');
    }

    public function test_update_modifies_product()
    {
        $product = Product::factory()->create([
            'name' => 'Original Name',
            'sale_price' => 100,
        ]);

        $updatedData = [
            'name' => 'Updated Name',
            'sale_price' => 200,
            'price' => 200,
            'stock' => 75,
            'stock_alert' => 15,
        ];

        $response = $this->put("/product/{$product->id}", $updatedData);

        $response->assertRedirect("/product/{$product->id}/edit")
            ->assertSessionHas('success', 'Product updated successfully.');

        $this->assertDatabaseHas('products', [
            'id' => $product->id,
            'name' => 'Updated Name',
            'sale_price' => 200,
        ]);
    }

    public function test_destroy_deletes_product()
    {
        $product = Product::factory()->create();

        $response = $this->delete("/product/{$product->id}");

        $response->assertStatus(200)
            ->assertJson(['error' => true]);

        $this->assertDatabaseMissing('products', [
            'id' => $product->id,
        ]);
    }

    public function test_get_price_returns_product_price_info()
    {
        $product = Product::factory()->create([
            'sale_price' => 150,
            'stock' => 100,
            'stock_alert' => 20,
        ]);

        $response = $this->get("/get-price/{$product->id}");

        $response->assertStatus(200)
            ->assertJson([
                'sale_price' => 150,
                'stock' => 100,
                'color' => 'green',
            ]);
    }

    public function test_get_price_returns_red_color_for_low_stock()
    {
        $product = Product::factory()->create([
            'stock' => 5,
            'stock_alert' => 10,
        ]);

        $response = $this->get("/get-price/{$product->id}");

        $response->assertStatus(200)
            ->assertJson([
                'color' => 'red',
            ]);
    }

    public function test_unauthorized_access_redirects_to_login()
    {
        auth()->logout();

        $response = $this->get('/product');

        $response->assertRedirect('/login');
    }

    public function test_requires_verified_email()
    {
        $unverifiedUser = User::factory()->create([
            'email_verified_at' => null,
        ]);

        $this->actingAs($unverifiedUser);

        $response = $this->get('/product');

        $response->assertRedirect('/email/verify');
    }
}
