<?php

namespace App\Http\Controllers;

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
        
        // $start_date = date('2023-03-14');
        // $end_date = date('2023-03-15');
        $result   = $this->dashboardStat($start_date,$end_date);
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

        $products = Product::withSum(['SaleProduct'
                =>function($query) use($start_date,$end_date){
                    $query->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date);
                }],
                'total')
                ->withSum(['ProductionProduct'
                =>function($query) use($start_date,$end_date){
                    $query->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date);
                }],'qty')
                ->get();

        $latest_sales = Sale::whereDate('created_at','>=',$start_date)
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

        $total_sales = $products->sum('sale_product_sum_total');
        $total_purchases_qty = $products->sum('production_product_sum_qty');

        $net_profit =   $total_sales -$purchases_history - $expenses;
        return [
            'latest_products'=>$latest_products,
            'users'=>$users,
            'latest_purchases'=>$latest_purchases,
            'latest_sales'=>$latest_sales,
            'products'=>$products,
            'latest_expenses'=>$latest_expenses,
            'expenses'=>$expenses,
            'total_sales'=>$total_sales,
            'total_purchases_qty'=>$total_purchases_qty,
            'purchases_history'=>$purchases_history,

            'net_profits'=>$net_profit,


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
