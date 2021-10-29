<?php

use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PoController;
use App\Http\Controllers\PoLineController;
use App\Http\Controllers\SaleOrderController;
use App\Http\Controllers\SaleOrderLineController;
use App\Http\Controllers\SupplierController;
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

Route::get('items/findwait', [ItemController::class, 'findItemWait']);
Route::post('item/updateStock', [ItemController::class, 'updateStock']);
Route::apiResource('items', \App\Http\Controllers\Api\ItemController::class);
Route::apiResource('customers', CustomerController::class);
Route::get('report', [SaleOrderController::class, 'report']);
Route::post('sale_order/towaitpay/{code}', [SaleOrderController::class, 'updateStatusToWaitPay']);
Route::post('sale_order/to_complete/{code}', [SaleOrderController::class, 'complete']);
Route::apiResource('sale_order', SaleOrderController::class);
Route::apiResource('sale_order_lines', SaleOrderLineController::class);
Route::post('po/to_wait_pay/{code}', [PoController::class, 'toWaitPay']);
Route::post('po/to_complete/{code}', [PoController::class, 'toComplete']);
Route::apiResource('po', PoController::class);
Route::apiResource('poline', PoLineController::class);
Route::apiResource('supplier', SupplierController::class);
