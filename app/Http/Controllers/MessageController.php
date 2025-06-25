<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MessageController extends Controller
{
    /**
     * Display a listing of the messages.
     */
    public function index()
    {
        $messages = Message::all();
        return view('message.index', ['data' => $messages]);
    }

    /**
     * Show the form for creating a new message.
     */
    public function create()
    {
        // Not used, handled via contact page or AJAX modal
    }

    /**
     * Store a newly created message in storage.
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
     * Display the specified message.
     */
    public function show(Message $message)
    {
        return view('message.show', ['data' => $message]);
    }

    /**
     * Show the form for editing the specified message.
     */
    public function edit(Message $message)
    {
        // Not used, messages are not edited
    }

    /**
     * Update the specified message in storage.
     */
    public function update(Request $request, Message $message)
    {
        // Not used, messages are not updated
    }

    /**
     * Remove the specified message from storage.
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

    /**
     * Show only review messages for homepage.
     */
    public function review()
    {
        $reviews = Message::where('category', 'review')->get();
        return view('homepage.index', ['reviews' => $reviews]);
    }

    /**
     * Show the detail modal via AJAX.
     */
    public function showDetail(Request $request)
    {
        $data = Message::find($request->input('id'));
        return response()->json([
            'status' => 'ok',
            'msg' => view('message.show', compact('data'))->render()
        ], 200);
    }
}
