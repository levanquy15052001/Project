<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandProductControler;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProductControler;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MannagentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Redirect;
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

// Route::get('Logout',[AdminController::class,'Logout'])->name('admin.logout');
// Route::post('Login',[AdminController::class,'Post_Login'])->name('admin.pots_login');
// Route::get('Register',[AdminController::class,'Register'])->name('admin.register');
// Route::get('Login',[AdminController::class,'Login'])->name('admin.login');
// Route::get('Logout',[AdminController::class,'Logout'])->name('admin.logout');


//         Route::get('Admin',[AdminController::class,'index'])->name('admin.index');
//         Route::get('Login',[AdminController::class,'Login'])->name('admin.login');
//         Route::get('Logout',[AdminController::class,'Logout'])->name('admin.logout');

Route::get('/',[HomeController::class,'index']);
Route::get('/Trang-chu',[HomeController::class,'index'])->name('index');
Route::get('Logout',[AdminController::class,'Logout'])->name('admin.logout');
Route::get('Login',[AdminController::class,'Login'])->name('admin.login');
Route::get('Register',[AdminController::class,'Register'])->name('user.Register');
Route::post('Register',[AdminController::class,'CheckRegister'])->name('userCheck.Register');
Route::post('Login',[AdminController::class,'Check_Login'])->name('admin.check_login');
Route::get('/show_detail',[HomeController::class,'show_detail'])->name('show_detail');

//cart
Route::middleware('User')->group(function(){
    Route::get('/show_cart',[CartController::class,'show_cart'])->name('show_cart');
    Route::post('/add_cart',[CartController::class,'add_cart'])->name('add_cart');
    Route::get('Cart-update',[CartController::class,'updatecart'])->name('cart.updatecart');
    Route::get('Check-out',[CartController::class,'check_out'])->name('check_out');
    Route::get('Infor-Order-New',[CartController::class,'inforOrderNew'])->name('inforOrderNew');
    Route::post('save_inforOrder',[CartController::class,'save_inforOrder'])->name('save_inforOrder');
    Route::post('Check-out',[CartController::class,'save_check_out'])->name('save_check_out');
    Route::get('payment',[CartController::class,'payment'])->name('payment');
    Route::get('/pdf_user',[HomeController::class,'pdf_user'])->name('pdf_user');

});

// /// Admin
Route::middleware('Admin')->group(function(){
    Route::get('Admin',[AdminController::class,'index'])->name('admin.index');
        ///Category Product
        Route::get('All-Category-Product',[CategoryProductControler::class,'All'])->name('admin.all_category');
        Route::post('Update-category',[CategoryProductControler::class,'update_category'])->name('update_category');
        Route::post('Add-category-product',[CategoryProductControler::class,'add_category_product'])->name('add_category_product');
        Route::get('Add-Category-Product',[CategoryProductControler::class,'Add'])->name('admin.add_category');
        Route::get('Custome-Category/{id}/{custome}',[CategoryProductControler::class,'Custom'])->name('admin.costome');
        Route::get('Update-category', function () {
            return Redirect::back();
          });
        // Brand Product
        Route::get('Add-brand-product',[BrandProductControler::class,'add_brand'])->name('admin.add_brand');
        Route::get('All-brand-product',[BrandProductControler::class,'all_brand'])->name('admin.all_brand');
        Route::post('Add-brand-product',[BrandProductControler::class,'post_add_brand'])->name('add_brand');
        Route::get('Custome-Brand/{id}/{custome}',[BrandProductControler::class,'Custom'])->name('admin.costome.brand');
        Route::post('Update-Category-Product',[BrandProductControler::class,'update_brand_product'])->name('admin.update_brand');
        Route::get('Update-Category-Product', function () {
            return Redirect::back();
          });

        // Product
        Route::get('Add-product',[ProductController::class,'add_product'])->name('admin.add_product');
        //Route::post('Search-product',[ProductController::class,'Search_product'])->name('admin.Search_product');
        Route::post('Add-product',[ProductController::class,'post_add_product'])->name('add_product');
        Route::get('All-product',[ProductController::class,'all_product'])->name('admin.all_product');
        Route::get('Custome-product/{id}/{custome}',[ProductController::class,'Custom'])->name('admin.costome.product');
        Route::post('Update-Product',[ProductController::class,'update_pruduct'])->name('update_pruduct');
        Route::get('Update-Product', function () {
          return Redirect::back();
        });

        ///Customer
        Route::prefix('customer')->name('customer.')->group(function () {
          Route::get('/',[CustomerController::class,'index'])->name('index');
        });
        
        Route::prefix('management')->name('management.')->group(function () {
          Route::get('/',[MannagentController::class,'index'])->name('index');
          Route::get('/order/{id}',[MannagentController::class,'order'])->name('order');
          Route::get('order-details',[MannagentController::class,'order_details'])->name('order_details');
          Route::get('pdf',[MannagentController::class,'pdf'])->name('pdf');
        });
        
});






    