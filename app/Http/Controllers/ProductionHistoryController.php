<?php

namespace App\Http\Controllers;

use App\Models\ProductionHistory;
use App\Http\Requests\StoreProductionHistoryRequest;
use App\Http\Requests\UpdateProductionHistoryRequest;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ProductionHistoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $production = ProductionHistory::paginate(10);
        return view('pages.production',compact('production'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        return view('pages.create-production');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductionHistoryRequest $request): RedirectResponse
    {
        $product = Product::find($request->product_id);
        if($product == null)
        throw new \ErrorException('Product not found');

        $product->increment('stock',abs($request->qty));

        $perchase = Purchase::find($request->product_id);

        $total_purchase_stock = $request->qty + $request->wastage_qty;
        $perchase->decrement('stock',$total_purchase_stock);


        $production = ProductionHistory::create($request->validated());
        return redirect('production');
    }

    /**
     * Display the specified resource.
     */
    public function show(ProductionHistory $production): View
    {
        return view('edit-production',compact('production'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProductionHistory $production): View
    {
        return view('pages.edit-production',compact('production'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductionHistoryRequest $request, ProductionHistory $production): RedirectResponse
    {
        $products = ProductionHistory::where('id',$production->id)->update($request->validated());
       return redirect('production/'.$production->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProductionHistory $production): RedirectResponse
    {
        $production->dalete();
        return redirect('production/'.$production->id);
    }
}
