<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Sale;
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

        // $start_date = date('Y-m-d');
        // $end_date = date('Y-m-d');

        // Expense::sum('amount')
        // ->whereDateBetween('created_at',[$start_date,$end_date])
        // ->get();
        // Product::withSum('SaleProduct','sale_price')
        //         ->withSum('PurchaseProduct','price')
        //         ->whereDateBetween('created_at',[$start_date,$end_date])
        //         ->get();

        // $latest_sales = Sale::take(10)->latest()->get();
        // $latest_purchases = Purchase::take(10)->latest()->get();
        // $products = Product::take(10)->latest()->get();
        // $users = User::take(10)
        // ->WhereNotIn('user_type','admin')
        // ->latest()
        // ->get();
        
        // dd("dd");
        return view('pages.dashboard');
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
