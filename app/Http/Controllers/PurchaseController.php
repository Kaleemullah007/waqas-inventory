<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePurchaseRequest;
use App\Http\Requests\UpdatePurchaseRequest;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseHistory;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class PurchaseController extends Controller
{
    public function __construct()
    {

        $this->middleware(['auth', 'verified']);

    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (auth()->user()->user_type != 'admin') {
            abort(403);
        }
        $purchases = $this->recordsQuery($request)->where('id', '>', 1)->paginate(auth()->user()->per_page ?? config('services.per_page', 10));
        if ($purchases->lastPage() >= request('page')) {
            return view('pages.purchase', compact('purchases'));
        }

        return to_route('purchase.index', ['page' => $purchases->lastPage()]);

    }

    public function recordsQuery($request)
    {
        // withoutGlobalScopes()->
        $purchases = Purchase::query()
            ->with('vendor');
        $search = $request->search;
        $dates = $request->daterange;

        if ($dates != null) {
            [$start_date, $end_date] = explode('-', $dates);
            $start_date = changeDateFormat($start_date, 'Y-m-d');
            $end_date = changeDateFormat($end_date, 'Y-m-d');
            $purchases = $purchases->whereDate('created_at', '>=', $start_date)
                ->whereDate('created_at', '<=', $end_date);
        }
        if ($search != null) {

            $purchases = $purchases->whereHas('vendor', function ($q) use ($search) {
                $q->where('name', 'like', '%'.$search.'%');
            })->orWhere('name', 'like', '%'.$search.'%');
        }

        return $purchases;
    }

    public function getPurchases(Request $request)
    {

        $purchases = $this->recordsQuery($request)->get();
        $purchase_html = view('pages.ajax-purchase', compact('purchases'))->render();
        $pagination_html = view('pages.pagination', compact('purchases'))->render();

        return response()->json(['html' => $purchase_html, 'phtml' => $pagination_html]);
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

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {

        // $products = Product::get();
        $vendors = User::where('owner_id', auth()->id())
            ->where('user_type', 'vendor')
            ->get();
        $raw = Purchase::get();
        $count = $raw->count();

        //    dd($raw);
        return view('pages.create-purchase', compact('vendors', 'raw', 'count'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePurchaseRequest $request): RedirectResponse
    {

        DB::transaction(function () use ($request) {

            if ($request->action == 'update') {
                $purchases = Purchase::find($request->raw_id);
                $purchases->increment('qty', $request->qty);
                $purchases->sale_price = $request->sale_price;
                $purchases->price = $request->price;
                $purchases->increment('total', $request->total);
                $purchases->save();
            } else {
                $purchases = Purchase::create($request->validated());
            }

            PurchaseHistory::create($request->validated());
        });

        $request->session()->flash('success', 'Purchase '.$request->action.' successfully.');

        return redirect('purchase');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase): View
    {
        return view('edit-purchase', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase): View
    {
        // return redirect('edit-purchase',compact('purchase'));
        // if($purchase == null)
        // throw new \ErrorException('purchase not found');
        // return view('pages.edit-purchase');

        // $products = Product::get();
        $vendors = User::where('owner_id', auth()->id())
            ->where('user_type', 'vendor')
            ->get();
        $raw = Purchase::get();
        $count = $raw->count();

        //    dd($raw);
        return view('pages.edit-purchase', compact('vendors', 'purchase', 'raw', 'count'));
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

        DB::transaction(function () use ($request, $purchase) {
            $data = $request->validated();

            Purchase::where('id', $purchase->id)->update($data);

            $difference = $purchase->qty - $request->qty;
            $total = -($difference * $request->price);

            $data['total'] = $total;
            $data['qty'] = $difference;
            $data['price'] = $request->price;
            $data['sale_price'] = $request->sale_price;

            PurchaseHistory::create($data);
        });
        $request->session()->flash('success', 'Purchase updated successfully.');

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
