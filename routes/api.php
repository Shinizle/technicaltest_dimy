<?php

use App\Http\Controllers\Api\CustomerController;
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
    Route::post('add-customer-address', [CustomerController::class, 'addCustomerAddress']);
});
