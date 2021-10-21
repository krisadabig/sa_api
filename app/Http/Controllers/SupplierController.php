<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $supplier = Supplier::all();
        return response($supplier);
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
            'name' => 'required',
            'phone_no' => 'required|regex:/[0-9]{9,}/'
        ], [
            'name.required' => 'name is required',
            'phone_no.required' => 'phone number is required',
            'phone_no.regex' => 'รูปแบบเบอร์โทรศัพท์ไม่ถูกต้อง'
        ]);
        if ($validator->fails()) {
            return response($validator->errors());
        } else {
            $supplier = new Supplier();
            $supplier->name = $request->name;
            $supplier->phone_no = $request->phone_no;
            $supplier->save();
            return response($supplier);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $supplier = Supplier::findOrFail($id);
        return response($supplier);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);
        foreach ($request->all() as $key => $value) {
            $supplier->$key = $value;
        }
        $supplier->save();
        return response($supplier);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
