<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::paginate(10);
        return view('pages.product',compact('products'));
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
        return redirect('product');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product): View
    {
        return view('edit-product',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): View
    {
        return view('pages.edit-product',compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $products = Product::where('id',$product->id)->update($request->validated());
       return redirect('product/'.$product->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->dalete();
        return redirect('product/'.$product->id);
    }

    public function getPrice(Product $product)
    {

        return response()->json(['sale_price'=>$product->sale_price],200);
    }

}
