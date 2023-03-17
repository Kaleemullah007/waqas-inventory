<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Product;
use App\Models\User;
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

        $sales = Sale::paginate(10);
        return view('pages.sale',compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $products = Product::get();
        $customers = User::where('owner_id',auth()->id())
        ->where('user_type','customer')
        ->get();
        return view('pages.create-sale',compact('products','customers'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSaleRequest $request): RedirectResponse
    {
        // dd($request->all());
        $product = Product::find($request->product_id);
        $product->decrement('stock',$request->qty);
        // $product->save();

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
        $products = Product::get();
        $customers = User::where('owner_id',auth()->id())
        ->where('user_type','customer')
        ->get();
        return view('pages.edit-sale',compact('products','customers','sale'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSaleRequest $request, Sale $sale):RedirectResponse
    {

        // Sale Stock  $o 5
        // New Stock  $n 4
        // Taking Difference  $d =  $o - $n
        // positive  increment   $d
        // negative decrement abs($d)


        $product = Product::find($request->product_id);
        if($product == null)
        throw new \ErrorException('Product not found');

        $difference = $sale->qty -  $request->qty;

        if($difference > 0){
            $product->increment('stock',$difference);
        }else{
            $product->decrement('stock',abs($difference));
        }



        Sale::where('id',$sale->id)->update($request->validated());

        return redirect('sale/'.$sale->id.'/edit');
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
