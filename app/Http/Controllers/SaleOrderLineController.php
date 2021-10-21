<?php

namespace App\Http\Controllers;

use App\Models\SaleOrderLine;
use Illuminate\Http\Request;

class SaleOrderLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $saleOrderLine = SaleOrderLine::all();
        return response($saleOrderLine);
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
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SaleOrderLine  $saleOrderLine
     * @return \Illuminate\Http\Response
     */
    public function show(SaleOrderLine $saleOrderLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SaleOrderLine  $saleOrderLine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SaleOrderLine $saleOrderLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SaleOrderLine  $saleOrderLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(SaleOrderLine $saleOrderLine)
    {
        //
    }
}
