<?php

namespace App\Http\Controllers;

use App\Models\SaleOrder;
use Illuminate\Http\Request;

class SaleOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sOrder = SaleOrder::with('saleOrderLines', 'saleOrderLines.item', 'customer')->get();
        return $sOrder;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sOrder = new SaleOrder();
        $sOrder->sale_order_code = $request->sale_order_code;
        $sOrder->status = $request->status;
        $sOrder->total_price = $request->total_price;
        $sOrder->save();
        return response($sOrder);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function show($sale_order_code)
    {
        $sOrder = SaleOrder::where('code', $sale_order_code)->first();
        return response($sOrder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $sale_order_code)
    {
        $sOrder = SaleOrder::where('sale_order_code', $sale_order_code)->first();
        foreach ($request->all() as $key => $value) {
            $sOrder->$key = $value;
        }
        $sOrder->save();
        return response($sOrder);
    }
    public function updateStatusToWaitPay($sale_order_code)
    {
        $sOrder = SaleOrder::where('sale_order_code', $sale_order_code)->first();
        $sOrder->status = 'WaitPay';
        $sOrder->save();
        return response($sOrder);
    }
    public function complete($sale_order_code)
    {
        $sOrder = SaleOrder::where('code', $sale_order_code)->first();
        $sOrder->status = 'Complete';
        $sOrder->save();
        $sOrder->complete_date = $sOrder->updated_at;
        $sOrder->save();
        return response($sOrder);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleOrder $saleOrder)
    {
        //
    }
}
