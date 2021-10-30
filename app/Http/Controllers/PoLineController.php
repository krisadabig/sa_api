<?php

namespace App\Http\Controllers;

use App\Models\PoLine;
use Illuminate\Http\Request;

class PoLineController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $poLine = PoLine::with('item', 'po')->get();
        return response($poLine);
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
     * @param  \App\Models\PoLine  $poLine
     * @return \Illuminate\Http\Response
     */
    public function show(PoLine $poLine)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PoLine  $poLine
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PoLine $poLine)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PoLine  $poLine
     * @return \Illuminate\Http\Response
     */
    public function destroy(PoLine $poLine)
    {
        //
    }
}
