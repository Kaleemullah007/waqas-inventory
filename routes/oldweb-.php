<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;

use App\Http\Controllers\SaleController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ExpenseController;

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

Route::group(['middleware' => ['Language','avoid-back-history'],
'prefix' => '{locale}',
'where' => ['locale' => '[a-zA-Z]{2}'],
], function () {


    Route::get('/', function () {
        if (isset($locale) && in_array($locale, config('app.available_locales'))) {
            app()->setLocale($locale);
        }

        return view('welcome');
    });

    Route::get('/language', function ($locale) {
        app()->setLocale($locale);
        session()->put('locale', $locale);
        return redirect()->back();
    })->name('language');


    Auth::routes(['verify'=>true]);


    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    // Route::group(['prefix'=>'peoples'],function(){

    // });
    Route::get('/people', [HomeController::class, 'index'])->name('people');

    Route::get('/customer', [HomeController::class, 'index'])->name('customer');
    // Route::group(['prefix'=>'peoples'],function(){
        
    // })


    Route::get('/supplier', [HomeController::class, 'index'])->name('supplier');
    // Route::group(['prefix'=>'peoples'],function(){
        
    // })

    Route::get('/user', [HomeController::class, 'index'])->name('user');
    // Route::group(['prefix'=>'peoples'],function(){
        
    // })

    Route::get('/expense-category', [HomeController::class, 'index'])->name('expense-category');
    // Route::group(['prefix'=>'peoples'],function(){
        
    // })

    Route::get('/purchase-payments', [HomeController::class, 'index'])->name('purchase-payments');
    // Route::group(['prefix'=>'peoples'],function(){
        
    // })

    Route::get('/plan', [HomeController::class, 'index'])->name('plan');
    // Route::group(['prefix'=>'peoples'],function(){
        
    // })

    Route::get('/roles', [HomeController::class, 'index'])->name('roles');
    // Route::group(['prefix'=>'peoples'],function(){
        
    // })

    Route::get('/group-permission', [HomeController::class, 'index'])->name('group-permission');
    // Route::group(['prefix'=>'peoples'],function(){
        
    // })

    Route::get('/products', [ProductController::class, 'index'])->name('home');
    // Route::group(['prefix'=>'peoples'],function(){
        
    // })

    Route::get('/sale', [SaleController::class, 'index'])->name('sale');
    // Route::group(['prefix'=>'peoples'],function(){
        
    // })

    Route::get('/purchase-retrun', [PurchaseController::class, 'purchaseReturn'])->name('purchase-retrun');


    Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase');
    Route::get('/permission', [PermissionController::class, 'index'])->name('permission');
    Route::get('/salereturn', [SaleController::class, 'saleReturn'])->name('salereturn');
    Route::get('/expense', [ExpenseController::class, 'index'])->name('expense');



    Route::get('/page/{page_slug}', [PageController::class,'index']);

});






// //------------------------------- Users --------------------------\\
//     //------------------------------------------------------------------\\

//     Route::get('GetUserAuth', 'UserController@GetUserAuth');
//     Route::get("/GetPermissions", "UserController@GetPermissions");
//     Route::resource('users', 'UserController');
//     Route::put('users/Activated/{id}', 'UserController@IsActivated');
//     Route::get('users/export/Excel', 'UserController@exportExcel');
//     Route::get('users/Get_Info/Profile', 'UserController@GetInfoProfile');
//     Route::put('updateProfile/{id}', 'UserController@updateProfile');

//     //------------------------------- Permission Groups user -----------\\
//     //------------------------------------------------------------------\\

//     Route::resource('roles', 'PermissionsController');
//     Route::resource('roles/check/Create_page', 'PermissionsController@Check_Create_Page');
//     Route::get('getRoleswithoutpaginate', 'PermissionsController@getRoleswithoutpaginate');
//     Route::post('roles/delete/by_selection', 'PermissionsController@delete_by_selection');


    // //------------------------------- Settings ------------------------\\
    // //------------------------------------------------------------------\\
    // Route::resource('settings', 'SettingsController');

    // Route::put('pos_settings/{id}', 'SettingsController@update_pos_settings');
    // Route::get('get_pos_Settings', 'SettingsController@get_pos_Settings');

    // Route::put('SMTP/{id}', 'SettingsController@updateSMTP');
    // Route::post('SMTP', 'SettingsController@CreateSMTP');
    // Route::get('getSettings', 'SettingsController@getSettings');
    // Route::get('getSMTP', 'SettingsController@getSMTP');
    // Route::get('get_sms_config', 'SettingsController@get_sms_config');


    // Route::post('payment_gateway', 'SettingsController@Update_payment_gateway');
    // Route::post('sms_config', 'SettingsController@sms_config');
    // Route::get('Get_payment_gateway', 'SettingsController@Get_payment_gateway');

    // //------------------------------- Backup --------------------------\\
    // //------------------------------------------------------------------\\

    // Route::get("GetBackup", "ReportController@GetBackup");
    // Route::get("GenerateBackup", "ReportController@GenerateBackup");
    // Route::delete("DeleteBackup/{name}", "ReportController@DeleteBackup");
