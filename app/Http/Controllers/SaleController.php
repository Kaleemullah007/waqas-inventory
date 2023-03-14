<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
       
        $sales = Sale::get();
        return view('pages.create-sale',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('pages.create-sale');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request): RedirectResponse
    {
        $product = Product::find($request->product_id);
        $product->decrement($request->stock);
        $product->save();

        $sales = Sale::create($request->validated());
        return redirect('sale');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale): View
    {
        return redirect('edit-sale',compact('sale'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sale $sale): View
    {
        // return redirect('edit-sale',compact('sale'));
        return view('pages.edit-sale');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale): RedirectResponse
    {

        // Sale Stock  $o 5 
        // New Stock  $n 4
        // Taking Difference  $d =  $o - $n  
        // positive  increment   $d
        // negative decrement abs($d)

        $product = Product::find($request->product_id);
        if($product == null)
        throw new \ErrorException('Product not found');
        $difference = $sale->qty -  $request->stock;
        if($difference > 0){
            $product->increment($difference);
        }else{
            $product->decrement(abs($difference));
        }

        
        $product->save();

        
        $sales = Sale::udpate($request->validated())->where('id',$sale->id);
        return redirect('sale/'.$sale->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sale $sale): RedirectResponse
    {
        $sale->dalete();
        return redirect('sale/'.$sale->id);
    }
}
