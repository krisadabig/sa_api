<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\POController;
use App\Http\Controllers\PoController as ControllersPoController;
use App\Http\Controllers\PoLineController;
use App\Http\Controllers\SaleOrderController;
use App\Http\Controllers\SaleOrderLineController;
use App\Http\Controllers\SupplierController;
use App\Models\Po;
use App\Models\SaleOrder;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('items', \App\Http\Controllers\Api\ItemController::class);
Route::apiResource('customers', CustomerController::class);
Route::post('sale_order/towaitpay/{sale_order_code}', [SaleOrderController::class, 'updateStatusToWaitPay']);
Route::post('sale_order/tocomplete/{sale_order_code}', [SaleOrderController::class, 'complete']);
Route::apiResource('sale_order', SaleOrderController::class);
Route::apiResource('sale_order_lines', SaleOrderLineController::class);
Route::apiResource('po', ControllersPoController::class);
Route::apiResource('poline', PoLineController::class);
Route::apiResource('supplier', SupplierController::class);
