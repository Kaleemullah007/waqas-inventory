<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->recordsQuery();

        if ($products->lastPage() >= request('page')) {
            return view('pages.product', compact('products'));
        }

        return to_route('product.index', ['page' => $products->lastPage()]);

    }

    public function recordsQuery($search = null)
    {
        // withoutGlobalScopes()->
        $products = new Product;

        if ($search != null) {

            $products = $products->where('name', 'like', '%'.$search.'%');
        }
        $products = $products->paginate(auth()->user()->per_page ?? config('services.per_page', 10));

        return $products;
    }

    public function CSV(Request $request)
    {

        $sales = $this->recordsQuery($request->daterange);
        $fileName = 'Sale Detail Report.csv';
        $headers = [
            'Content-type' => 'text/csv',
            'Content-Disposition' => "attachment; filename=$fileName",
            'Pragma' => 'no-cache',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Expires' => '0',
        ];

        $columns = ['', 'Customer Name', 'Product Name', 'Sale Price', 'Qty', 'Stock', 'Discount', 'Price'];

        $callback = function () use ($sales, $columns) {

            $sale_price = 0;
            $total_qty = 0;
            $total_stock = 0;
            $total_discount = 0;
            $total_price = 0;
            $file = fopen('php://output', 'w');
            fputcsv($file, [' ', ' ', ' ', 'Sale Detail Report']);
            fputcsv($file, $columns);

            foreach ($sales as $key => $sale) {
                $orders = [];
                $sale_price += $sale->sale_price;
                $total_qty += $sale->qty;
                $total_stock += $sale->stock;
                $total_discount += $sale->discount;
                $total_price += $sale->price;

                $orders = [
                    '',
                    $sale->Customer->name,
                    $sale->Product->name,
                    $sale->sale_price,
                    $sale->qty,
                    $sale->stock,
                    $sale->discount,
                    $sale->price,
                ];
                fputcsv($file, $orders);
            }

            $columns = ['', '', '', '', '', '', '', ''];
            $columns = ['', '', '', '', '', '', '', ''];
            $columns = ['', '', '', '', '', '', '', ''];
            $columns = ['', '', '', '', '', '', '', ''];
            fputcsv($file, $columns);

            $columns = ['', '', '', $sale_price, $total_qty, $total_stock, $total_discount, $total_price];
            fputcsv($file, $columns);

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    // Get Products

    public function getProducts(Request $request)
    {

        $products = $this->recordsQuery($request->search);
        $products_html = view('pages.ajax-product', compact('products'))->render();
        $pagination_html = view('pages.pagination', compact('products'))->render();

        return response()->json(['html' => $products_html, 'phtml' => $pagination_html]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        return view('pages.create-product');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductRequest $request): RedirectResponse
    {
        $products = Product::create($request->validated());
        $request->session()->flash('success', 'Product created successfully.');

        return redirect('product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('edit-product', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('pages.edit-product', compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $products = Product::where('id', $product->id)->update($request->validated());
        $request->session()->flash('success', 'Product updated successfully.');

        return redirect('product/'.$product->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // dd($product);
        $error = false;
        if ($product->delete()) {
            $error = true;
        }

        return response()->json(['error' => $error]);
    }

    public function getPrice(Product $product)
    {

        $color = 'red';
        if ($product->stock > $product->stock_alert) {
            $color = 'green';
        }

        return response()->json(['sale_price' => $product->sale_price, 'stock' => $product->stock, 'color' => $color], 200);
    }
}
