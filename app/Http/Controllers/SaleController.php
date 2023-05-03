<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use App\Http\Requests\StoreSaleRequest;
use App\Http\Requests\UpdateSaleRequest;
use App\Models\Product;
use App\Models\SaleProduct;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;
use Barryvdh\DomPDF\Facade\Pdf;

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

        
        if($customer_id != null && $customer_id != 'Choose Customer'){
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

        }


        return $sales->orderBy('created_at','DESC') ;
    }

    public function getSales(Request $request)
    {


        $sales = $this->recordsQuery($request)->get();
        $sale_html = view('pages.ajax-sale',compact('sales'))->render();
        $pagination_html = view('pages.pagination',compact('sales'))->render();
        return response()->json(['html'=>$sale_html,'phtml'=>$pagination_html]);

        
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
        $products = array_filter($request->products);
        $productIds = collect($products)->pluck('product_id');
        $qty_sum = collect($products)->sum('qty');

        $DBProducts = Product::find($productIds)
        ->keyBy('id');
        $sub_total_cost = 0;

        $sale_products  = array();
        // dd($qty_sum,$request->products);
        $subtotal = collect($request->products)->reduce(function($carry,$item){
            return $carry + $item['sale_price']*$item['qty'];
        },0);

        $total = $subtotal - $request->discount;

        $request->total = $total;

        foreach ($products as $index => $products_array) {
            if(!isset($DBProducts[$products_array['product_id']]))
            continue;
            $temp = array();
            $temp['product_name'] = $DBProducts[$products_array['product_id']]->name;
            $temp['product_id']   = $DBProducts[$products_array['product_id']]->id;
            $temp['sale_id']   = 0;  // $sales->id
            $temp['qty']   = $products_array['qty'];
            $sub_total_cost += $products_array['qty'] * $DBProducts[$products_array['product_id']]->price;
            $DBProducts[$products_array['product_id']]->decrement('stock',$products_array['qty']);
            $temp['cost_price']   = $DBProducts[$products_array['product_id']]->price;
            $temp['sale_price']   = $products_array['sale_price'];
            $sale_products[] = $temp;
        }

        $cost_total = $sub_total_cost - $request->discount;
        $calcualted_values = [
            'sub_total'=>$subtotal,
            'sub_total_cost'=>$sub_total_cost-$request->discount,
            'total_qty'=>$qty_sum,
            'total'=>$total,
            'cost_total'=>$sub_total_cost,
            'tax'=>0

        ];
        $sale_data = array_merge($request->validated(),$calcualted_values);
        $sales = Sale::create($sale_data);

        $sale_products= array_map(function($item) use($sales) {
            $item['sale_id'] =  $sales->id;
            return $item;
       },$sale_products);


        SaleProduct::insert($sale_products);


        $request->session()->flash('success','Sale created successfully.');

        return redirect()->route('sale.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sale $sale):View
    {
        $sales = $sale->load('Products','Customer');

        return view('pages.view-sale',compact('sales'));
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
        $products = array_filter($request->products);
        $productIds = collect($products)->pluck('product_id');
        $qty_sum = collect($products)->sum('qty');

        $DBProducts = Product::find($productIds)
        ->keyBy('id');
        $sub_total_cost = 0;

        $sale_products  = array();
        $subtotal = collect($request->products)->reduce(function($carry,$item){
            return $carry + $item['sale_price']*$item['qty'];
        },0);

        $total = $subtotal - $request->discount;
        $request->total = $total;
        $DBSaleProducts = SaleProduct::where('sale_id',$sale->id)
        ->get()
        ->keyBy('product_id');
        foreach ($products as $index => $products_array) {
            if(!isset($DBProducts[$products_array['product_id']]))
            continue;
            $temp = array();
            $temp['product_name'] = $DBProducts[$products_array['product_id']]->name;
            $temp['product_id']   = $DBProducts[$products_array['product_id']]->id;
            $temp['sale_id']   = 0;  // $sales->id
            $temp['qty']   = $products_array['qty'];
            $sub_total_cost += $products_array['qty'] * $DBProducts[$products_array['product_id']]->price;
            $difference = $DBSaleProducts[$products_array['product_id']]->qty -  $products_array['qty'];
            if($difference > 0){
                $DBProducts[$products_array['product_id']]->increment('stock',abs($difference));
            }else{
                $DBProducts[$products_array['product_id']]->decrement('stock',abs($difference));
            }



            $temp['cost_price']   = $DBProducts[$products_array['product_id']]->cost_price;
            $temp['sale_price']   = $products_array['sale_price'];
            $sale_products[] = $temp;
        }

        $cost_total = $sub_total_cost - $request->discount;
        $calcualted_values = [
            'sub_total'=>$subtotal,
            'cost_total'=>$sub_total_cost,
            'total_qty'=>$qty_sum,
            'total'=>$total,
            'cost_total'=>$cost_total,
            'tax'=>0

        ];
        $sale_data = array_merge($request->validated(),$calcualted_values);
        unset($sale_data['products']);
        // dd($sale_data);
        $sale_products= array_map(function($item) use($sale) {
            $item['sale_id'] =  $sale->id;
            return $item;
       },$sale_products);

       SaleProduct::where('sale_id',$sale->id)->delete();
       SaleProduct::insert($sale_products);
       Sale::where('id',$sale->id)->update($sale_data);

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
        $products  = $request->products;

        $products = Product::whereNotIn('id',array_values($products))->get();
        $html = view('pages.row',compact('new_row','totalrecords','products'))->render();
        return $html;

    }

    public function generatePDF($id){
        $sales = Sale::with(['Products','Customer'])
        ->whereId($id)->first();

        $pdf = Pdf::loadView('pages.print', compact('sales'));
        return $pdf->download('invoice.pdf');
    }

}
