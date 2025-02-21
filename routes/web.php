<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DepositHistoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductionHistoryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/product_price', function () {
    return response()->json([1, 2, 4]);
})->name('product_price');

Route::get('/', function () {

    return to_route('login');
});
Route::get('get-csv-sales', [SaleController::class, 'CSV']);

Route::get('get-csv-products', [SaleController::class, 'CSV']);
Route::get('get-csv-purchases', [SaleController::class, 'CSV']);
Route::get('get-csv-expenses', [SaleController::class, 'CSV']);
Route::get('get-csv-productions', [SaleController::class, 'CSV']);

Route::group([
    'middleware' => ['avoid-back-history'],

], function () {

    Auth::routes(['verify' => true]);

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('get-dashboard', [HomeController::class, 'getDashboard']);

    Route::get('/user-profile-setting', [SettingController::class, 'userProfileSetting'])->name('user-profile-setting');
    Route::post('profile-update', [SettingController::class, 'update'])->name('profile-update');

    Route::get('/setting', [SettingController::class, 'Setting'])->name('setting');
    Route::post('get-products', [ProductController::class, 'getProducts']);
    Route::resource('product', ProductController::class);
    Route::get('get-price/{product}', [ProductController::class, 'getPrice']);
    route::get('add-new-row', [SaleController::class, 'addNewRow']);
    route::get('update-products', [SaleController::class, 'UpdateProducts']);

    Route::post('get-sales', [SaleController::class, 'getSales']);
    Route::get('generate-pdf/{id}', [SaleController::class, 'generatePDF'])->name('generate-pdf');
    Route::resource('sale', SaleController::class)->middleware('avoid-back-history');
    Route::post('get-purchases', [PurchaseController::class, 'getPurchases']); // Pending
    Route::resource('purchase', PurchaseController::class);
    Route::post('get-expenses', [ExpenseController::class, 'getExpenses']); // Pending
    Route::resource('expense', ExpenseController::class);
    Route::post('get-productions', [ProductionHistoryController::class, 'getProduction']); // Pending
    Route::resource('production', ProductionHistoryController::class);
    Route::post('get-customers', [CustomerController::class, 'getCustomers']); // Pending
    Route::resource('customer', CustomerController::class);
    Route::resource('vendor', VendorController::class);
    route::get('deposit-html', [DepositHistoryController::class, 'index']);
    Route::resource('deposit', DepositHistoryController::class);

});
