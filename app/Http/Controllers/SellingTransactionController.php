<?php

namespace App\Http\Controllers;

use App\Models\SellingTransaction;
use Illuminate\Http\Request;

class SellingTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = SellingTransaction::all();
        return view('sellingtransaction.index',['data'=>$queryBuilder]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\SellingTransaction  $sellingTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(SellingTransaction $sellingTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SellingTransaction  $sellingTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(SellingTransaction $sellingTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SellingTransaction  $sellingTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SellingTransaction $sellingTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SellingTransaction  $sellingTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(SellingTransaction $sellingTransaction)
    {
        //
    }
}
