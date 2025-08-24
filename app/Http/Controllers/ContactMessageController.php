<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContactMessage;
use App\Http\Controllers\ErrorController;

class ContactMessageController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::where('user_id', auth()->id())->latest()->get();

        return response()->json($messages, 200);
        // return (new ErrorController)->badRequest();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        if (auth()->check()) {
            $validated['user_id'] = auth()->id();
        }

        $message = ContactMessage::create($validated);

        return response()->json([
            'message' => 'Contact message submitted successfully.',
            'data' => $message,
        ], 201);
    }

    public function show($id)
    {
        $message = ContactMessage::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (! $message) {
            return app(ErrorController::class)->notFound('Contact message not found');
        }

        return response()->json($message, 200);
    }

    public function update(Request $request, $id)
    {
        $message = ContactMessage::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (! $message) {
            return app(ErrorController::class)->notFound('Message not found or unauthorized');
        }

        $validated = $request->validate([
            'name' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string',
        ]);

        $message->update($validated);

        return response()->json([
            'message' => 'Message updated successfully.',
            'data' => $message,
        ], 200);
    }

    public function destroy($id)
    {
        $message = ContactMessage::where('id', $id)
            ->where('user_id', auth()->id())
            ->first();

        if (! $message) {
            return app(ErrorController::class)->notFound('Message not found or unauthorized');
        }

        $message->delete();

        return response()->json(['message' => 'Contact message deleted successfully.'], 200);
    }
}
