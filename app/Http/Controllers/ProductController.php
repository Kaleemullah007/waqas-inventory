<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $products = Product::get();
        return view('product',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(StoreProductRequest $request): Response
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
    public function show(Product $product): Response
    {
        return redirect('edit-product',compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product): Response
    {
        // return redirect('edit-product',compact('product'));
        return view('pages.edit-product');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        $products = Product::udpate($request->validated())->where('id',$product->id);
        return redirect('product/'.$product->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product): RedirectResponse
    {
        $product->dalete();
        return redirect('product/'.$product->id);
    }
}
