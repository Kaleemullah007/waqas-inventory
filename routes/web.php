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

    // Route::get('/admin-panel-setting', [SettingController::class, 'adminPanelSetting'])->name('admin-panel-setting');
        // Route::get('/system-setting', [SettingController::class, 'systemSetting'])->name('system-setting');
        // Route::get('/warehouse', [SettingController::class, 'warehouseSetting'])->name('warehouse');
        // Route::get('/brand', [SettingController::class, 'brandSetting'])->name('brand');
        // Route::get('/currency', [SettingController::class, 'currencySetting'])->name('currency');
        // Route::get('/unit', [SettingController::class, 'unitSetting'])->name('unit');
        // Route::get('/backup', [SettingController::class, 'backupSetting'])->name('backup');

        Route::get('/group', [SettingController::class, 'Group'])->name('group');
        Route::get('/create-group', [SettingController::class, 'createGroup'])->name('create-group');
        Route::get('/module', [SettingController::class, 'Module'])->name('module');
        Route::get('/create-module', [SettingController::class, 'createModule'])->name('create-module');
        Route::get('/user', [SettingController::class, 'User'])->name('user');
        Route::get('/create-user', [SettingController::class, 'createUser'])->name('create-user');
        Route::get('/email-placeholder', [SettingController::class, 'emailPlaceholder'])->name('email-placeholder');
        Route::get('/email-template', [SettingController::class, 'emailTemplate'])->name('email-template');
        Route::get('/create-blog', [SettingController::class, 'createBlog'])->name('create-blog');
        Route::get('/edit-blog', [SettingController::class, 'editBlog'])->name('edit-blog');
        Route::get('/blog', [SettingController::class, 'Blog'])->name('blog');

        // invertory routes below
        Route::get('/product', [ProductController::class, 'Product'])->name('product');
        Route::get('/create-product', [ProductController::class, 'createProduct'])->name('create-product');
        Route::get('/edit-product', [ProductController::class, 'editProduct'])->name('edit-product');

        // Route::get('/sale', [SaleController::class, 'index'])->name('sale');
        Route::get('/create-sale', [SaleController::class, 'create'])->name('create-sale');
        Route::get('/edit-sale', [SaleController::class, 'editSale'])->name('edit-sale');

        // Route::resource(['sales'=> SaleController::class]);

        Route::get('/purchase', [PurchaseController::class, 'Purchase'])->name('purchase');
        Route::get('/create-purchase', [PurchaseController::class, 'createPurchase'])->name('create-purchase');
        Route::get('/edit-purchase', [PurchaseController::class, 'editPurchase'])->name('edit-purchase');

        Route::get('/expense', [ExpenseController::class, 'Expense'])->name('expense');
        Route::get('/create-expense', [ExpenseController::class, 'createExpense'])->name('create-expense');
        Route::get('/edit-expense', [ExpenseController::class, 'editExpense'])->name('edit-expense');


        Route::post('sale-form', [SaleController::class,'store'])->name('sale-form');





        // Route::group(['prefix' => 'manageUser'], function () {
        //     Route::get('/group', [manageUserController::class, 'Group'])->name('group');
        //     Route::get('/sale', [SaleController::class, 'Sale'])->name('sale');
        //     Route::get('/sale-return', [SaleController::class, 'saleReturn'])->name('sale-return');
        //     Route::get('/create-sale-return', [SaleController::class, 'createsaleReturn'])->name('create-sale-return');
        // });

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

