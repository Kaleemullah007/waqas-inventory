<?php

namespace App\Http\Controllers;

use App\Models\DepositHistory;
use App\Models\Expense;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseHistory;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Termwind\Components\Raw;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        $this->middleware(['auth', 'verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function welcome()
    {
        // dd("dd");
        return view('welcome');
    }


    public function index(Request $request)
    {

        $start_date = date('Y-m-01');
        $end_date = date('Y-m-d');
        $result   = $this->dashboardStat($start_date,$end_date);

        // dd($result);
        return view('pages.dashboard',compact('result'));
    }


    public function getDashboard(Request $request)
    {

        $dates = $request->daterange;
        list($start_date,$end_date) = explode('-',$dates);
        $start_date = changeDateFormat($start_date,'Y-m-d');
        $end_date = changeDateFormat($end_date,'Y-m-d');
        $result   = $this->dashboardStat($start_date,$end_date);

        $dashboard_html = view('pages.ajax-dashboard',compact('result'))->render();
        return response()->json(['html'=>$dashboard_html]);

    }


    public function dashboardStat($start_date,$end_date){


        $expenses = Expense::whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->sum('amount');

        $latest_expenses = Expense::whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->take(10)
        ->latest()
        ->get();

        // $products = Product::withSum(['SaleProduct'
        //         =>function($query) use($start_date,$end_date){
        //             $query->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date);
        //         }],
        //         'total')
        //         ->withSum(['ProductionProduct'
        //         =>function($query) use($start_date,$end_date){
        //             $query->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date);
        //         }],'qty')
        //         ->get();


                $sales = Sale::query()
                // ->Sum('cost_total')
                // ->Sum('total')
                // ->Sum('total_qty')
                ->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date)
                // ->sum('total')
                // ->sum('discount')
                // ->sum('remaning_amount')
                // ->sum('paid_amount')
                ->get();


                // dd($sales);

                $products_sum_cost_price = $sales->sum('cost_total');
                $products_sum_sale_price = $sales->sum('total');
                $products_sum_qty = $sales->sum('total_qty');
                $total = $sales->sum('total');
                $discount = $sales->sum('discount');
                $paid_amount = $sales->sum('paid_amount');
                $remaining_amount = $sales->sum('remaining_amount');
                $cost_total = $sales->sum('cost_total');
                $total_qty = $sales->sum('total_qty');
                $cash_in_hand = $sales->where('payment_method','Cash')->sum('paid_amount');


                $other_in_hand = $sales->where('payment_method','!=','Cash')->sum('paid_amount');


                $sub_total_cost = $sales->sum('sub_total_cost');
                $cost_total = $sales->sum('cost_total');
                $products_sum_sale_price= Sale::query()
                ->sum('total');


                $amount = DepositHistory::sum('amount');
                $remaining_amount = Sale::query()
                ->sum('remaining_amount');
                $remaining_amount = $remaining_amount-$amount;

                // dd($sales);


        $latest_sales = Sale::with(['Customer','Products'])->whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->take(10)
        ->latest()
        ->get();

        $latest_purchases = Purchase::whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->take(10)->latest()->get();

        $purchases_history = PurchaseHistory::whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->latest()->sum(DB::raw('price*qty'));

        $latest_products = Product::whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->take(10)
        ->latest()->get();
        $users = User::whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->WhereNotIn('user_type',['vendor'])
        ->take(10)
        ->latest()
        ->get();

        $total_sales = $products_sum_sale_price; //$sales->sum('sale_product_sum_total');
        $total_purchases_qty = $sales->sum('production_product_sum_qty');

        $net_worth =   $purchases_history - $total_sales;
            if($net_worth > 0){
                $net_worth =  $net_worth - $expenses;
            }
            else{
                $net_worth =  $net_worth + $expenses;
            }

        $net_profit =  $total - $cost_total - $expenses ;
        return [
            'latest_products'=>$latest_products,
            'users'=>$users,
            'latest_purchases'=>$latest_purchases,
            'latest_sales'=>$latest_sales,
            'products'=>$sales,
            'latest_expenses'=>$latest_expenses,
            'expenses'=>$expenses,
            'total_sales'=>$total_sales,
            'total_purchases_qty'=>$total_purchases_qty,
            'purchases_history'=>$purchases_history,
            'net_profits'=>$net_profit,
            'net_worth'=>$net_worth,

            'products_sum_cost_price' => $products_sum_cost_price,
            'products_sum_sale_price' => $products_sum_sale_price,
            'products_sum_qty' => $products_sum_qty,
            'total' => $total,
            'discount' => $discount,
            'paid_amount' => $paid_amount,
            'remaining_amount' => $remaining_amount,
            'cost_total' => $cost_total,
            'total_qty' => $total_qty,
            'cash_in_hand' => $cash_in_hand,
            'other_in_hand' => $other_in_hand,



        ];
    }
    function changeLang($langcode)
    {


        App::setLocale($langcode);
        session()->put("lang_code", $langcode);
        return redirect()->back();
    }
    public function POS()
    {
        return view('pages.pos');
    }
}
