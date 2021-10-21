<?php

namespace App\Http\Controllers;

use App\Models\Po;
use Illuminate\Http\Request;

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
