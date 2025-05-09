<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $queryBuilder = Message::all();
        return view('message.index',['data'=>$queryBuilder]);
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
        $data = new Message();
        $data->name = $request->get('name');
        $data->contact = $request->get('contact');
        $data->subject = $request->get('subject');
        $data->category = $request->get('category');
        $data->message = $request->get('message');
        $data->post_time = now();


        $data->save();

        return redirect('/contact')->with('status','Message has been sent');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function edit(Message $message)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Message $message)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        try{
            $message->delete();
            return redirect()->route('messages.index')->with('status','Message has been deleted');
        }catch(\Exception $e){
            return redirect()->route('messages.index')->with('error','Message cannot be deleted');
        }
    }

    public function review(){
        $reviews = Message::where('category','review')->get();
        return view('homepage/index',['reviews'=>$reviews]);
    }

    public function showDetail(Request $request){
        $data=Message::find($_POST['id']);
        return response()->json(array(
            'status'=>'ok',
            'msg'=>view('message.show',compact('data'))->render()
        ),200);
    }
}
