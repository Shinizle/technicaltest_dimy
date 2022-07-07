<?php

use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\ProductController;
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

Route::group(['prefix' => 'products'], function () {
    Route::get('get-all-products', [ProductController::class, 'getAllProducts']);
    Route::get('get-product', [ProductController::class, 'getProduct']);
    Route::post('add-new-product', [ProductController::class, 'addNewProduct']);
    Route::patch('update-product', [ProductController::class, 'updateProduct']);
    Route::delete('delete-product', [ProductController::class, 'deleteProduct']);
});

Route::group(['prefix' => 'customers'], function () {
    Route::get('get-all-customers', [CustomerController::class, 'getAllCustomer']);
    Route::post('create-customer', [CustomerController::class, 'createCustomer']);
    Route::get('get-customer-addresses', [CustomerController::class, 'getCustomerAddresses']);
    Route::post('add-customer-address', [CustomerController::class, 'addCustomerAddress']);
});

Route::group(['prefix' => 'payment-methods'], function () {
    Route::get('get-all-payment-methods', [PaymentMethodController::class, 'getAllPaymentMethods']);
    Route::post('add-payment-methods', [PaymentMethodController::class, 'addNewPaymentMethods']);
});

Route::group(['prefix' => 'orders'], function () {
    Route::get('get-all-orders', [OrderController::class, 'getAllOrders']);
    Route::get('get-all-order-products', [OrderController::class, 'getAllOrderProducts']);
    Route::post('create-order', [OrderController::class, 'createOrder']);
});
