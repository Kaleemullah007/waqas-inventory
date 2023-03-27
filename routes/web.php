<?php

use App\Http\Controllers\CustomerController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\manageUserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\ProductionHistoryController;
use App\Models\Customer;
use Auth\VerificationController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/product_price',function(){
    return response()->json([1,2,4]);
})->name('product_price');

Route::get('/', function () {

    return view('welcome');
});
Route::get('get-csv-sales',[SaleController::class,'CSV']);



Route::get('get-csv-products',[SaleController::class,'CSV']);
Route::get('get-csv-purchases',[SaleController::class,'CSV']);
Route::get('get-csv-expenses',[SaleController::class,'CSV']);
Route::get('get-csv-productions',[SaleController::class,'CSV']);

Route::group([
    'middleware' => ['avoid-back-history'],

], function () {

    Auth::routes(['verify' => true]);


    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('get-dashboard',[HomeController::class,'getDashboard']);


    Route::get('/user-profile-setting', [SettingController::class, 'userProfileSetting'])->name('user-profile-setting');
    Route::get('/setting', [SettingController::class, 'Setting'])->name('setting');
        Route::post('get-products',[ProductController::class,'getProducts']);
        Route::resource('product',ProductController::class);
        Route::get('get-price/{product}',[ProductController::class,'getPrice']);
        Route::post('get-sales',[SaleController::class,'getSales']);
        Route::resource('sale',SaleController::class)->middleware('avoid-back-history');
        Route::post('get-purchases',[SaleController::class,'getSales']);
        Route::resource('purchase',PurchaseController::class);
        Route::post('get-expenses',[SaleController::class,'getSales']);
        Route::resource('expense',ExpenseController::class);
        Route::post('get-productions',[SaleController::class,'getSales']);
        Route::resource('production',ProductionHistoryController::class);
        Route::resource('customer',CustomerController::class);


});


