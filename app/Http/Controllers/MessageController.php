<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    /**
     * Display a listing of resources.
     */
    public function index()
    {
        $messages = Message::orderBy('post_time', 'desc')->get();
        return view('message.index', ['data' => $messages]);
    }

    /**
     * Show the form for creating resources.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resources in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'category' => 'required|in:review,order,question,other',
            'message' => 'required|string',
        ]);

        try {
            $message = new Message();
            $message->name = $validated['name'];
            $message->contact = $validated['contact'] ?? '';
            $message->subject = $validated['subject'] ?? '';
            $message->category = $validated['category'];
            $message->message = $validated['message'];
            $message->post_time = now();
            $message->save();

            return redirect('/contact')->with('status', 'Message has been sent');
        } catch (\Exception $e) {
            Log::error('Message store failed', ['error' => $e->getMessage()]);
            return redirect('/contact')->with('error', 'Failed to send message: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resources.
     */
    public function show(Message $message)
    {
        return view('message.show', ['data' => $message]);
    }

    /**
     * Show the form for editing the specified resources.
     */
    public function edit(Message $message)
    {
    }

    /**
     * Update the specified resources in storage.
     */
    public function update(Request $request, Message $message)
    {

    }

    /**
     * Remove the specified resources from storage.
     */
    public function destroy(Message $message)
    {
        try {
            $message->delete();
            return redirect()->route('messages.index')->with('status', 'Message has been deleted');
        } catch (\Exception $e) {
            Log::error('Message delete failed', ['error' => $e->getMessage()]);
            return redirect()->route('messages.index')->with('error', 'Message cannot be deleted');
        }
    }

    public function review()
    {
        $reviews = Message::where('category', 'review')->get();
        return view('homepage.index', ['reviews' => $reviews]);
    }

    public function showDetail(Request $request)
    {
        $data = Message::find($request->input('id'));
        return response()->json([
            'status' => 'ok',
            'msg' => view('message.show', compact('data'))->render()
        ], 200);
    }

    public function sendMessages(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'nullable|string|max:255',
            'subject' => 'nullable|string|max:255',
            'category' => 'required|in:review,order,question,other',
            'message' => 'required|string',
        ]);

        try {
            $message = new Message();
            $message->name = $validated['name'];
            $message->contact = $validated['contact'] ?? '';
            $message->subject = $validated['subject'] ?? '';
            $message->category = $validated['category'];
            $message->message = $validated['message'];
            $message->post_time = now();
            $message->save();

            return redirect('/contact')->with('status', 'Message has been sent');
        } catch (\Exception $e) {
            Log::error('Message store failed', ['error' => $e->getMessage()]);
            return redirect('/contact')->with('error', 'Failed to send message: ' . $e->getMessage());
        }
    }
}
