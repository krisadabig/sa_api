<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Po;
use App\Models\PoLine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $po = Po::with('poLines', 'poLines.item', 'supplier')->get();

        // $po->map(function ($po) {
        //     return collect($po->poLines->item)->all();
        // });
        return response($po);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validator = Validator::make($request->all(), [
            'code' => 'unique:pos',
        ], [
            'unique' => 'รหัสใบสั่งซื้อซ้ำ'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'error' => $validator->errors()
            ]);
        } else {
            $po = new Po();
            $po->code = $request->code;
            $po->supplier_id = $request->supplier_id;
            $po->status = $request->status;
            $po->total_price = $request->total_price;
            $po->save();

            foreach ($request->po_lines as $value) {
                # code...
                if ($value['quantity'] > 0 && $value['price_per_unit'] > 0) {

                    $poLine = new PoLine();
                    $poLine->po_code = $value["po_code"];
                    $poLine->color_code = $value["color_code"];
                    $poLine->quantity = $value["quantity"];
                    $poLine->price_per_unit = $value["price_per_unit"];
                    $poLine->save();
                } else {
                    $resPo = Po::where('code', $request->code)->with('poLines')->first();
                    $resPo->delete();
                    $toRes = $validator->errors()->add("quantity", __("จำนวนสินค้าที่สั่งและราคาต่อหน่วยต้องเป็น 1 ขึ้นไป"));


                    return response()->json([
                        "status" => "failed",
                        "error" =>  $toRes
                    ]);
                }
            }
            return response()->json([
                "status" => "success",
                "data" =>  $po
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Po  $po
     * @return \Illuminate\Http\Response
     */
    public function show(Po $po)
    {
        // 
        $po = Po::where('code', $po->code)->with('poLines', 'poLines.item', 'supplier')->first();
        return response($po);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Po  $po
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Po $po)
    {
        //
    }

    public function toWaitPay($code)
    {
        $po = Po::where('code', $code)->with('poLines')->first();
        $po->status = "WaitPay";
        $po->save();

        foreach ($po->poLines as $value) {
            # code...
            $item = Item::where('code', $value->color_code)->first();
            $item->amount += $value->quantity;
            $item->save();
        }
        return response()->json([
            'status' => 'success'
        ]);
    }

    public function toComplete($code)
    {
        $po = Po::where('code', $code)->first();
        $po->status = "Complete";
        $po->save();
        return response()->json([
            'status' => 'success'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Po  $po
     * @return \Illuminate\Http\Response
     */
    public function destroy(Po $po)
    {
        //
    }
}
