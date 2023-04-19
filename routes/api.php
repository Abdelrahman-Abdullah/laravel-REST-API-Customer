<?php

use App\Http\Controllers\Api\V1\AuthController;
use App\Http\Controllers\Api\V1\CustomerController;
use App\Http\Controllers\Api\V1\InvoiceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::group(['prefix' => 'v1' ,'namespace' => 'App\Http\Controllers\Api\V1'] , function (){
    Route::get('customers'              ,  [CustomerController::class , 'index']);
    Route::get('customers/{customer}'   ,  [CustomerController::class , 'show']);
    Route::get('invoices'               ,  [InvoiceController::class  , 'index']);
    Route::get('invoices/{invoice}'     ,  [InvoiceController::class  , 'show']);
    Route::post('users/register'        ,  [AuthController::class     , 'register']);
    Route::post('users/login'           ,  [AuthController::class     , 'login']);
});

// Protected Routes
Route::group(['prefix' => 'v1' , 'middleware' => 'auth:sanctum' , 'namespace' => 'App\Http\Controllers\Api\V1'] , function (){
    Route::apiResource('customers' , CustomerController::class)
        ->only('store' , 'update' , 'destroy');

    Route::apiResource('invoices'  , InvoiceController::class)
        ->only('store' , 'update' , 'destroy');

    Route::post('invoices/bulk' , [InvoiceController::class , 'bulkStore']);
    Route::post('users/logout' ,  [AuthController::class     , 'logout']);

});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
