<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class PurchaseController extends Controller
{
 /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $purchases = Purchase::get();
        return view('pages.purchase',compact('purchases'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        // return view('purchase');
        return view('pages.create-purchase');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request): RedirectResponse
    {

        $product = Product::find($request->product_id);
        $product->increment('stock',$request->qty);
        // $product->save();
        $purchases = Purchase::create($request->validated());
        return redirect('purchase');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase): View
    {
        return redirect('edit-purchase',compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase): View
    {
        // return redirect('edit-purchase',compact('purchase'));
        return view('pages.edit-purchase');

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePurchaseRequest $request, Purchase $purchase): RedirectResponse
    {
        // product 5
        // purchase Stock  $o 5    // 10
        // New Stock  $n 4
        // Taking Difference  $d =  $o - $n =  1
        // positive decrement  abc($d)
        // negative increment   $d
// dd($request->all());

        $product = Product::find($request->product_id);
        if($product == null)
        throw new \ErrorException('Product not found');
        $difference = $purchase->qty -  $request->qty;
        if($difference > 0){
            $product->decrement('stock',$difference);

        }else{
            $product->increment('stock',abs($difference));
        }

        $purchases = Purchase::where('id',$purchase->id)->update($request->validated());
        return redirect('purchase/'.$purchase->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase): RedirectResponse
    {
        $purchase->dalete();
        return redirect('purchase/'.$purchase->id);
    }
}
