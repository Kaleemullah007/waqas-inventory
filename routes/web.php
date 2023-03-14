<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\manageUserController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\ExpenseController;
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

Route::get('/', function () {

    return view('welcome');
});


Route::group([
    'middleware' => ['avoid-back-history'],

], function () {

    Auth::routes(['verify' => true]);

    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::get('/user-profile-setting', [SettingController::class, 'userProfileSetting'])->name('user-profile-setting');
    Route::get('/setting', [SettingController::class, 'Setting'])->name('setting');

        Route::resource('product',ProductController::class);
        Route::resource('sale',SaleController::class);
        Route::resource('purchase',PurchaseController::class);
        Route::resource('expense',ExpenseController::class);

});


