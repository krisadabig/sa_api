<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ItemController;
use App\Models\SaleOrder;
use App\Models\SaleOrderLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPSTORM_META\map;

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
        $validator = Validator::make($request->all(), [
            'code' => 'unique:sale_orders',
        ], [
            'unique' => 'เลขกำกับใบสั่งขายซ้ำ'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'error' => $validator->errors()->first()
            ]);
        } else {
            $sOrder = new SaleOrder();
            $sOrder->code = $request->code;
            $sOrder->customer_id = $request->customer_id;
            $sOrder->status = $request->status;
            $sOrder->paymentMethod = $request->paymentMethod;
            $sOrder->total_price = $request->total_price;
            $sOrder->save();

            foreach ($request->sale_order_lines as $value) {
                # code...
                $sOrderLines = new SaleOrderLine();
                $sOrderLines->sale_order_code =  $value['sale_order_code'];
                $sOrderLines->color_code = $value['color_code'];
                $sOrderLines->quantity = $value['quantity'];
                $item = new ItemController();
                $res = $item->updateStock($value['color_code'], $value['quantity']);
                if ($res->getData()->status === 'failed') {
                    $resSaleOrder = SaleOrder::where('code', $request->code)->with('saleOrderLines')->first();
                    $resSaleOrder->delete();
                    return response()->json([
                        'status' => "failed",
                        'error' => $res->getData()->error,
                    ]);
                }
                $sOrderLines->save();
            }
            $resSaleOrder = SaleOrder::where('code', $request->code)->with('saleOrderLines')->first();
            return response()->json([
                "status" => "success",
                "data" => $resSaleOrder,
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function show($code)
    {
        $sOrder = SaleOrder::where('code', $code)->with('saleOrderLines', 'saleOrderLines.item', 'customer')->first();
        return response($sOrder);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleOrder  $saleOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        $sOrder = SaleOrder::where('code', $code)->first();
        foreach ($request->all() as $key => $value) {
            $sOrder->$key = $value;
        }
        $sOrder->save();
        return response($sOrder);
    }
    public function updateStatusToWaitPay($code)
    {
        $sOrder = SaleOrder::where('code', $code)->first();
        $sOrder->status = 'WaitPay';
        $sOrder->save();
        return response($sOrder);
    }
    public function complete($code)
    {
        $sOrder = SaleOrder::where('code', $code)->first();
        $sOrder->status = 'Complete';
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
