<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BasicRequestController;
use App\Http\Controllers\Api\CheckoutController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\UserAddressController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\WishlistController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group([],function(){
    Route::post("/login",[AuthController::class,'login']);
    Route::post("/register",[AuthController::class,'register']);
    Route::get("/get-banners",[BasicRequestController::class,'getBannerList']);
    Route::post("/feedback",[BasicRequestController::class,'addFeedback']);
    Route::post('/init',[BasicRequestController::class,'init']);
    Route::post('/get-category-wise-products',[ProductController::class,'getCategoryWiseProduct']);
    Route::post('/product-details',[ProductController::class,'show']);
    Route::post("/get-all-products",[ProductController::class,'getAllProducts']);
    Route::post("/get-checkout-products",[CheckoutController::class,'getCheckoutProducts']);
});

Route::group(['middleware'=>'auth:api'],function(){
    Route::group(['prefix'=>"profile"],function(){
        Route::get('/',[UserController::class,'getProfile']);
        Route::post("/change-password",[UserController::class,'changePassword']);
        Route::post('/add-address',[UserAddressController::class,'addAddress']);
        Route::post('/place-order',[OrderController::class,'placeOrder']);
        Route::post('/apply-coupon',[CheckoutController::class,'applyCoupon']);
        Route::post('/get-my-orders',[OrderController::class,'getUserOrder']);
        Route::post('/add-to-wishlist',[WishlistController::class,'store']);
        Route::post('/get-my-wishlist',[WishlistController::class,'index']);
        Route::post('/remove-wishlist-product',[WishlistController::class,'destroy']);
        Route::post('/get-order-details',[OrderController::class,'getOrderDetails']);
        Route::post('/confirm-payment',[OrderController::class,'confirmPayment']);

    });
    Route::post('/logout',[AuthController::class,'logout']);

});
