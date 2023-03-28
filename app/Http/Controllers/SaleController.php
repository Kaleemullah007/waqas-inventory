<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;


class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $sales = $this->recordsQuery($request)->paginate(10);
        $customers = User::where('user_type','customer')->get();
        return view('pages.sale',compact('sales','customers'));
    }

    public function CSV(Request $request)
    {

        $sales = $this->recordsQuery($request)->get();
        $fileName = 'Sale Detail Report.csv';
        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );


        $columns = array('','Customer Name','Product Name', 'Sale Price','Qty','Stock','Discount','Price');


        $callback = function() use($sales, $columns) {

            $sale_price = 0;
            $total_qty = 0;
            $total_stock = 0;
            $total_discount = 0;
            $total_price = 0;
                $file = fopen('php://output', 'w');
                fputcsv($file, array(' ',' ',' ','Sale Detail Report'));
                fputcsv($file, $columns);

                foreach ($sales as $key => $sale) {
                    $orders = array();
                    $sale_price += $sale->sale_price;
                    $total_qty += $sale->qty;
                    $total_stock += $sale->stock;
                    $total_discount += $sale->discount;
                    $total_price += $sale->price;

                    $orders = array(
                        '',
                        $sale->Customer->name,
                        $sale->Product->name,
                        $sale->sale_price,
                        $sale->qty,
                        $sale->stock,
                        $sale->discount,
                        $sale->price,
                    );
                    fputcsv($file, $orders);
                }

                $columns = array('','','', '','','','','');
                $columns = array('','','', '','','','','');
                $columns = array('','','', '','','','','');
            $columns = array('','','', '','','','','');
            fputcsv($file, $columns);

            $columns = array('','','', $sale_price,$total_qty,$total_stock,$total_discount,$total_price);
            fputcsv($file, $columns);

            fclose($file);
        };


        return response()->stream($callback, 200, $headers);
    }


    public function recordsQuery($request)
    {
        // withoutGlobalScopes()->
        $dates = $request->daterange;
        $search = $request->search;

        $customer_id = $request->customer_id??null;
        $sales = Sale::
        with(['Customer','Product','Products']);
        if($dates != null){
            list($start_date,$end_date) = explode('-',$dates);


           $start_date = changeDateFormat($start_date,'Y-m-d');
           $end_date = changeDateFormat($end_date,'Y-m-d');
            $sales =$sales->whereDate('created_at','>=',$start_date)
            ->whereDate('created_at','<=',$end_date);
        }

        if($customer_id != null){
            $sales = $sales->where('user_id',$customer_id);
        }
        if($search != null){

            $sales = $sales->whereHas('Product',function($q) use($search){
                $q->where('name','like',"%".$search."%");
            });
            $sales = $sales->orWhereHas('Customer',function($q) use($search){
                $q->where('name','like',"%".$search."%");
            });

            return $sales ;
            // dd($search,$sales->get());
        }


        return $sales ;
    }

    public function getSales(Request $request)
    {


        $sales = $this->recordsQuery($request)->get();
        $sale_html = view('pages.ajax-sale',compact('sales'))->render();
        return response()->json(['html'=>$sale_html]);
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
        dd($request->all());
        $product = Product::find($request->product_id);
        $product->decrement('stock',$request->qty);
        // $product->save();

        $sales = Sale::create($request->validated());
        return redirect('sale');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale):View
    {
        $sale = $sale->load('Products');
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

        // dd($request->all());
        $product = Product::find($request->product_id);
        if($product == null){
            $request->session()->flash('warning','Product not found.');
            throw new \ErrorException('Product not found');
        }


        $difference = $sale->qty -  $request->qty;

        if($difference > 0){
            $product->increment('stock',$difference);
        }else{
            $product->decrement('stock',abs($difference));
        }



        Sale::where('id',$sale->id)->update($request->validated());
        $request->session()->flash('success','Sale updated successfully.');
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

        /**
     * Add the specified row from .
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function addNewRow(Request $request)
    {
        $new_row = $request->new_row;
        $totalrecords = $request->totalrecords;
        $products = Product::get();
        $html = view('pages.row',compact('new_row','totalrecords','products'))->render();
        return $html;

    }

}
