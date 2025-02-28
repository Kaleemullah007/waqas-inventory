<?php

namespace Tests\Feature;

use App\Http\Controllers\SaleController;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleProduct;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SaleControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected $user;

    protected $customer;

    protected $products;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create([
            'user_type' => 'admin',
            'invoice_template' => 'view-sale',
        ]);

        $this->customer = User::factory()->create([
            'user_type' => 'customer',
            'owner_id' => $this->user->id,
        ]);

        $this->products = Product::factory()->count(3)->create([
            'owner_id' => $this->user->id,
            'stock' => 100,
            'price' => 50,
        ]);

        $this->actingAs($this->user);
    }

    public function test_update_modifies_sale()
    {
        // Create initial sale
        $sale = Sale::factory()->create([
            'owner_id' => $this->user->id,
            'user_id' => $this->customer->id,
            'payment_status' => 'unpaid',
            'payment_method' => 'cash',
            'paid_amount' => 0,
            'remaining_amount' => 0,
            'total' => 0,
        ]);

        // Create initial sale products
        $initialProducts = [];
        foreach ($this->products as $product) {
            $initialProducts[] = [
                'sale_id' => $sale->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'qty' => 10,
                'cost_price' => $product->price,
                'sale_price' => $product->price * 1.2,
            ];
        }
        SaleProduct::insert($initialProducts);

        // Prepare update data
        $updateData = [
            'user_id' => $this->customer->id,
            'products' => [
                [
                    'product_id' => $this->products[0]->id,
                    'qty' => 5,
                    'sale_price' => 60,
                ],
                [
                    'product_id' => $this->products[1]->id,
                    'qty' => 15,
                    'sale_price' => 70,
                ],
            ],
            'discount' => 50,
            'payment_status' => 'paid',
            'payment_method' => 'cash',
            'paid_amount' => 1000,
            'remaining_amount' => 0,
            'total' => 1000,
        ];

        $response = $this->put("/sale/{$sale->id}", $updateData);

        $response->assertRedirect("/sale/{$sale->id}/edit")
            ->assertSessionHas('success', 'Sale updated successfully.');

        // Assert sale was updated
        $this->assertDatabaseHas('sales', [
            'id' => $sale->id,
            'user_id' => $this->customer->id,
            'payment_status' => 'paid',
            'payment_method' => 'cash',
        ]);

        // Assert products were updated
        $this->assertDatabaseHas('sale_products', [
            'sale_id' => $sale->id,
            'product_id' => $this->products[0]->id,
            'qty' => 5,
            'sale_price' => 60,
        ]);

        // Assert stock was adjusted
        $this->products[0]->refresh();
        $this->assertEquals(105, $this->products[0]->stock); // Initial 100 + 5 returned
    }

    public function test_add_new_row()
    {
        $request = [
            'new_row' => 1,
            'totalrecords' => 1,
            'products' => [$this->products[0]->id],
        ];

        $response = $this->get('add-new-row?'.http_build_query($request));

        $response->assertStatus(200)
            ->assertSee('Product')
            ->assertSee('Quantity');

    }

    public function test_generate_pdf()
    {
        $user = $this->user; // Store user reference

        $products = Product::factory()->count(2)->create([
            'owner_id' => $this->user->id,
            'stock' => 1000,
            'price' => 50,
        ]);

        $sale = Sale::factory()
            ->has(SaleProduct::factory()
                ->count(2)
                ->state(function (array $attributes) use ($user) {
                    $product = Product::factory()->create([
                        'owner_id' => $user->id,
                        'stock' => 1000,
                        'price' => 50,
                        'sale_price' => 60,
                    ]);

                    return [
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'cost_price' => $product->price,
                        'sale_price' => $product->sale_price,
                    ];
                }), 'saleProducts'
            )
            ->create([
                'owner_id' => $this->user->id,
                'user_id' => $this->customer->id,
                'payment_status' => 'paid',
                'payment_method' => 'cash',
                'paid_amount' => 1000,
                'remaining_amount' => 0,
                'total' => 1000,
                'total_qty' => 10,
            ]);

        $response = $this->get("/sale/{$sale->id}");

        $response->assertStatus(200);
    }

    public function test_update_products_dropdown()
    {
        Product::factory()->count(2)->create([
            'owner_id' => $this->user->id,
            'stock' => 1000,
            'price' => 50,
            'name' => 'Product1',
        ]);

        $request = [
            'products' => ['Choose'],
        ];

        $response = $this->get('/update-products?'.http_build_query($request));

        $response->assertStatus(200)
            ->assertSee('Product1');

    }

    public function test_get_invoice_fields()
    {
        $currentMonth = date('n'); // Get month number without leading zeros
        $currentYear = date('Y');
        $monthName = config('Invoice')[$currentMonth]; // Get month name from config
        $expectedSeries = $monthName.$currentYear;

        // Create some sales to test serial number increment
        for ($i = 0; $i < 3; $i++) {
            Sale::factory()->create([
                'owner_id' => $this->user->id,
                'serial_series' => $expectedSeries,
                'serial_number' => $i + 1,
                'serial' => $expectedSeries.'-'.($i + 1),
                'payment_status' => 'paid',
                'payment_method' => 'cash',
                'paid_amount' => 1000,
                'remaining_amount' => 0,
                'total' => 1000,
                'total_qty' => 10,
                'user_id' => $this->customer->id,
            ]);
        }

        $controller = new SaleController;
        [$series, $serial_number, $serial_series] = $controller->getInvoiceFields();

        $this->assertEquals($expectedSeries, $series);
        $this->assertEquals(4, $serial_number); // Should be 4 because we created 3 sales
        $this->assertEquals($expectedSeries.'-'.$serial_number, $serial_series);
    }

    public function test_update_validates_product_stock()
    {
        $sale = Sale::factory()->create([
            'owner_id' => $this->user->id,
            'user_id' => $this->customer->id,
            'payment_status' => 'paid',
            'payment_method' => 'cash',
            'paid_amount' => 1000,
            'remaining_amount' => 0,
            'total' => 1000,
            'total_qty' => 10,

        ]);

        $product = Product::factory()->create([
            'owner_id' => $this->user->id,
            'stock' => 5,
        ]);

        $updateData = [
            'user_id' => $this->customer->id,
            'products' => [
                [
                    'product_id' => $product->id,
                    'qty' => 10, // More than available stock
                    'sale_price' => 60,
                ],
            ],
            'discount' => 0,
            'payment_status' => 'paid',
            'payment_method' => 'cash',
            'paid_amount' => 600,
            'remaining_amount' => 0,
            'total' => 600,
        ];

        $response = $this->put("/sale/{$sale->id}", $updateData);

        $response->assertSessionHasErrors('products');
    }

    public function test_update_calculates_totals_correctly()
    {
        $sale = Sale::factory()->create([
            'owner_id' => $this->user->id,
            'user_id' => $this->customer->id,
            'payment_status' => 'paid',
            'payment_method' => 'cash',
            'paid_amount' => 1000,
            'remaining_amount' => 0,
            'total' => 1000,
            'total_qty' => 10,

        ]);

        $updateData = [
            'user_id' => $this->customer->id,
            'products' => [
                [
                    'product_id' => $this->products[0]->id,
                    'qty' => 2,
                    'sale_price' => 100,
                ],
                [
                    'product_id' => $this->products[1]->id,
                    'qty' => 3,
                    'sale_price' => 150,
                ],
            ],
            'discount' => 50,
            'payment_status' => 'paid',
            'payment_method' => 'cash',
            'paid_amount' => 650,
            'remaining_amount' => 0,
            'total' => 650,
        ];

        $response = $this->put("/sale/{$sale->id}", $updateData);

        $sale->refresh();

        // Subtotal should be (2 * 100) + (3 * 150) = 650
        // Total after discount should be 650 - 50 = 600
        $this->assertEquals(650, $sale->sub_total);
        $this->assertEquals(600, $sale->total);
    }

    public function test_destroy_deletes_sale()
    {
        $products = $this->products;
        $sale = Sale::factory()
            ->has(SaleProduct::factory()
                ->count(2)
                ->state(function (array $attributes) use ($products) {
                    return [
                        'product_id' => $products[0]->id,
                        'product_name' => $products[0]->name,
                        'cost_price' => $products[0]->price,
                        'sale_price' => $products[0]->sale_price,
                        'qty' => 5,
                    ];
                }), 'saleProducts'
            )
            ->create([
                'owner_id' => $this->user->id,
                'user_id' => $this->customer->id,
                'payment_status' => 'paid',
                'payment_method' => 'cash',
                'paid_amount' => 1000,
                'remaining_amount' => 0,
                'total' => 1000,
                'total_qty' => 10,
                'sub_total' => 1000,
                'cost_total' => 800,
                'sub_total_cost' => 800,
                'tax' => 0,
                'discount' => 0,
                'serial' => 'Jan2023',
                'serial_number' => 1,
                'serial_series' => 'Jan2023-1',
                'due_date' => null,
                'payment_due_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $response = $this->delete("/sale/{$sale->id}");

        $response->assertRedirect(route('sale.index'))
            ->assertSessionHas('success', 'Sale deleted successfully');
        $this->assertSoftDeleted('sales', ['id' => $sale->id]);

    }

    public function test_unauthorized_user_cannot_update_sale()
    {
        $products = $this->products;
        $sale = Sale::factory()
            ->has(SaleProduct::factory()
                ->count(2)
                ->state(function (array $attributes) use ($products) {
                    return [
                        'product_id' => $products[0]->id,
                        'product_name' => $products[0]->name,
                        'cost_price' => $products[0]->price,
                        'sale_price' => $products[0]->sale_price,
                        'qty' => 5,
                    ];
                }), 'saleProducts'
            )
            ->create([
                'owner_id' => $this->user->id,
                'user_id' => $this->customer->id,
                'payment_status' => 'paid',
                'payment_method' => 'cash',
                'paid_amount' => 1000,
                'remaining_amount' => 0,
                'total' => 1000,
                'total_qty' => 10,
                'sub_total' => 1000,
                'cost_total' => 800,
                'sub_total_cost' => 800,
                'tax' => 0,
                'discount' => 0,
                'serial' => 'Jan2023',
                'serial_number' => 1,
                'serial_series' => 'Jan2023-1',
                'due_date' => null,
                'payment_due_date' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        $user= User::factory()->create(['user_type' => 'customer']);
        $this->actingAs($user);

        $response = $this->put("/sale/{$sale->id}", [
        'user_id' => $user->id,
        'discount' => 0.00,
        'payment_status' => 'pending',
        'payment_method' => 'cash',
        'paid_amount' => 0.00,
        ]);

        $response->assertStatus(403);
    }
}
