<?php

namespace App\Http\Controllers;

use App\Models\BuyingTransaction;
use Illuminate\Http\Request;

class BuyingTranscationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = BuyingTransaction::all();
        return view('buyingtransaction.index',['data'=>$queryBuilder]);
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
     * @param  \App\Models\BuyingTransaction  $buyingTransaction
     * @return \Illuminate\Http\Response
     */
    public function show(BuyingTransaction $buyingTransaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BuyingTransaction  $buyingTransaction
     * @return \Illuminate\Http\Response
     */
    public function edit(BuyingTransaction $buyingTransaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BuyingTransaction  $buyingTransaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BuyingTransaction $buyingTransaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BuyingTransaction  $buyingTransaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(BuyingTransaction $buyingTransaction)
    {
        //
    }
}
