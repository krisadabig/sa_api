<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Po;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::orderBy('code')->get();
        return response($item);
    }

    public function findItemWait($code)
    {
        // $item = Item::where('code', $code)->whereHas('poLines.po', function ($q) {
        //     $q->where('status', 'Wait');
        // })->with('poLines.po')->get();
        $item = Po::where('status', 'Wait')->whereHas('poLines', function ($q) use ($code) {
            $q->where('color_code', $code);
        })->with('poLines')->get();
        // $item = Po::with('poLines', 'poLines.item')->where('status', 'Wait')->get();
        if ($item->count()) {
            return response()->json([
                'status' => 'success',
                'data' => $item
            ]);
        } else {
            return response()->json([
                'status' => 'failed'
            ]);
        }
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
            'code' => 'unique:items',
            'price' => 'numeric|min:1',
            'min_amount' => 'numeric|min:0'
        ], [
            'code.unique' => 'เลขกำกับใบสั่งขายซ้ำ',
            'price.min' => 'ราคาต่อหน่วยต้องเป็น 1 ขึ้นไป',
            'min_amount.min' => 'จำนวนคงเหลือขั้นต่ำต้องเป็น 0 ขึ้นไป'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'error' => $validator->errors()
            ]);
        } else {
            $item = new Item();
            $item->code = $request->code;
            $item->price = $request->price;
            $item->amount = $request->amount;
            $item->min_amount = $request->min_amount;
            $item->save();
            return response()->json([
                'status' => "success",
                'data' => $item
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($color_code)
    {
        $item = Item::findOrFail($color_code);
        return response($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $code)
    {
        $validator = Validator::make($request->all(), [
            'code' => Rule::unique('items')->ignore($code, 'code'),
            'price' => 'numeric|min:1',
            'min_amount' => 'numeric|min:0'
        ], [
            'unique' => 'เลขกำกับใบสั่งขายซ้ำ',
            'price.min' => 'ราคาต่อหน่วยต้องเป็น 1 ขึ้นไป',
            'min_amount.min' => 'จำนวนคงเหลือขั้นต่ำต้องเป็น 0 ขึ้นไป'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'error' => $validator->errors()
            ]);
        } else {
            $item = Item::where('code', $code)->first();

            foreach ($request->all() as $key => $value) {
                $item->$key = $value;
            }
            $item->save();

            return response()->json([
                'status' => 'success',
                'data' => $item
            ]);
        }
    }

    public function updateStock($code, $subAmount)
    {
        $item = Item::where('code', $code)->first();
        $validator = Validator::make(["subAmount" => $subAmount], [
            'subAmount' => 'numeric|min:1|max:' . $item->amount,
        ], [
            'subAmount.min' => 'จำนวนที่ซื้อต้องเป็น 1 ขึ้นไป',
            'subAmount.max' => 'จำนวนที่ซื้อต้องไม่เกินจำนวนสินค้าที่มีอยู่',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 'failed',
                'error' => $validator->errors()
            ]);
        }
        $item->amount -= $subAmount;
        $item->save();
        return response()->json([
            'status' => 'success',
            'data' => "from updateStock"
        ]);
    }

    public function getOrderStatus($code)
    {
        $po = Po::with('poLines', 'poLines.item')->where('poLines.color_code', $code)->get();
        return response($po);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
