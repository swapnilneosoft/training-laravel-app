<?php

use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SubCategoryController;
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



Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/mail',function(){
    return view("mail.usermail");
});

Route::group(["middleware" => ["auth", "RoleCheck"], "prefix" => "admin"], function () {
    Route::get("dashboard", [DashboardController::class, 'index'])->name("admin-dashboard");

    // Users operations route
    Route::get("/user-list", [DashboardController::class, 'getUserList'])->name("user-list");
    Route::get("/add-user", [DashboardController::class, 'getAddUser'])->name("add-user");
    Route::post('/add-user', [UserController::class, 'store']);
    Route::get('/delete-user/{id}', [UserController::class, 'destroy']);
    Route::get('/update-user/{id}', [UserController::class, 'edit']);
    Route::post('/update-user/{id}', [UserController::class, 'update']);
    Route::get("/status-user/{id}", [UserController::class, 'statusManage']);

    // Ajax user search
    Route::get('/user/search/{query}', [UserController::class, 'search']);

    // Banner Operations Routes
    Route::get("/banner-list", [DashboardController::class, 'getBannerList'])->name("banner-list");
    Route::get("/add-banner", [DashboardController::class, 'getAddBanner'])->name("add-banner");
    Route::post("/add-banner", [BannerController::class, 'store']);
    Route::get('/delete-banner/{id}', [BannerController::class, 'destroy']);
    Route::get('/update-banner/{id}', [BannerController::class, 'edit']);
    Route::post('/update-banner/{id}', [BannerController::class, 'update']);
    Route::get("/banner-image/preview/{id}", [BannerController::class, 'imagePreview']);
    Route::get("/status-banner/{id}", [BannerController::class, 'statusManage']);

    // Category Operations Routes
    Route::get("/category-list", [DashboardController::class, 'getCategoryList'])->name("category-list");
    Route::post("/add-category", [CategoryController::class, 'store'])->name("add-category");
    Route::get('/delete-category/{id}', [CategoryController::class, 'destroy']);
    Route::get('/update-category/{id}', [CategoryController::class, 'edit']);
    Route::post('/update-category/{id}', [CategoryController::class, 'update']);
    // Search api
    Route::get('/category/search/{q}', [CategoryController::class, 'search']);
    Route::get("/get-subcategory/{id}", [CategoryController::class, 'getSubcategoriesById']);

    // Sub Category Routes
    Route::group(["prefix" => "sub-category"], function () {
        Route::get('list', [DashboardController::class, 'getSubCategoryList'])->name('sub-category-list');
        Route::post('list', [SubCategoryController::class, 'store']);
        Route::get('delete/{id}', [SubCategoryController::class, 'destroy']);
        Route::get('update/{id}', [SubCategoryController::class, 'edit']);
        Route::post('update/{id}', [SubCategoryController::class, 'update']);
    });

    Route::group(["prefix" => 'product'], function () {
        Route::get('list', [DashboardController::class, 'getProductList'])->name("product-list");
        Route::get('add', [DashboardController::class, 'getAddProduct'])->name("product-add");
        Route::post('add', [ProductsController::class, 'store']);
        Route::get('delete/{id}', [ProductsController::class, 'destroy']);
        Route::get('preview/{id}', [ProductsController::class, 'show']);
        Route::get('update/{id}', [ProductsController::class, 'edit']);
        Route::post('update/{id}', [ProductsController::class, 'update']);
    });

    Route::group(["prefix" => "coupon"], function () {
        Route::get("/list", [DashboardController::class, 'getCouponList'])->name("coupon-list");
        Route::get("/add", [DashboardController::class, 'getAddCouponList'])->name('add-coupon');
        Route::post("/add", [CouponController::class, 'store']);
        Route::get("/update/{id}", [CouponController::class, 'edit']);
        Route::post("/update/{id}", [CouponController::class, 'update']);
        Route::get("/delete/{id}", [CouponController::class, 'destroy']);

        Route::get('/status/{id}', [CouponController::class, 'statusManage'])->name('coupon-status');
    });

    Route::group(["prefix" => "contact"], function () {
        Route::get("/list", [DashboardController::class, 'getContactList'])->name("contact-list");
        Route::get("/delete/{id}", [ContactController::class, 'destroy']);
        Route::get('/status/{id}', [ContactController::class, 'statusManage'])->name("contact-status");
    });

    Route::group(["prefix"=>"order"],function(){
        Route::get("/all-orders",[OrderController::class,'getAllOrders'])->name("all-order-list");
        Route::get("/pending-orders",[OrderController::class,'getPendingOrders'])->name("pending-order-list");
        Route::get("/delivered-orders",[OrderController::class,'getDeliveredOrders'])->name("delivered-order-list");
        Route::get("/preview/{id}",[OrderController::class,'orderPreview'])->name("order-preview");
        Route::post('/status',[OrderController::class,'statusManage'])->name("manage-status");
    });
    Route::group(["prefix"=>"report"],function(){
        Route::post('/customer',[ReportController::class,'getCustomerReport'])->name("customer-report");
        Route::post('/used-coupon',[ReportController::class,'getUsedCouponReport'])->name("used-coupon-report");
        Route::post('/sales',[ReportController::class,'getSalesReport'])->name("sales-report");
    });
});

require __DIR__ . '/auth.php';
