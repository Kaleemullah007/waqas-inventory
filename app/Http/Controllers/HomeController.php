<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

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


    public function index()
    {

        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');

        // $start_date = date('2023-03-14');
        // $end_date = date('2023-03-15');
        $result   = $this->dashboardStat($start_date,$end_date);

        return view('pages.dashboard',compact('result'));
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
                ->withSum(['PurchaseProduct'
                =>function($query) use($start_date,$end_date){
                    $query->whereDate('created_at','>=',$start_date)->whereDate('created_at','<=',$end_date);
                }],'total')
                ->get();

        $latest_sales = Sale::whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->take(10)
        ->latest()
        ->get();

        $latest_purchases = Purchase::whereDate('created_at','>=',$start_date)
        ->whereDate('created_at','<=',$end_date)
        ->take(10)->latest()->get();

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
        $total_purchase = $products->sum('purchase_product_sum_total');
        $net_profit =   $total_sales -$total_purchase - $expenses;
        return [
            'latest_products'=>$latest_products,
            'users'=>$users,
            'latest_purchases'=>$latest_purchases,
            'latest_sales'=>$latest_sales,
            'products'=>$products,
            'latest_expenses'=>$latest_expenses,
            'expenses'=>$expenses,
            'total_sales'=>$total_sales,
            'total_purchases'=>$total_purchase,
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
