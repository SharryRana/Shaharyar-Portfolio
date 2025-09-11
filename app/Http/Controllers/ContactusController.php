<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact\Contactus;
use Stevebauman\Location\Facades\Location;
use Illuminate\Validation\ValidationException;

class ContactusController extends Controller
{


    public function index()
    {
        $messages = Contactus::orderBy('read_or_not', 'asc')->latest()->paginate(6);
        $unreadCount = Contactus::where('read_or_not', 0)->count();
        return view('admin.messages.message', compact('messages', 'unreadCount'));
    }


    public function create(Request $request)
    {
        try {

            $request->validate(
                [
                    'name' => 'required|string|max:255',
                    'email' => 'required|email|max:255',
                    'subject' => 'required|string|max:255',
                    'message' => 'required|string|max:15000',
                ],
                [
                    'name.required' => 'Please enter your name.',
                    'email.required' => 'Please enter your email address.',
                    'email.email' => 'Please enter a valid email address.',
                    'subject.required' => 'Please enter the subject.',
                    'message.required' => 'Please enter your message.',
                    'message.max' => 'Your message is too long. Maximum 15000 characters allowed.',
                ]
            );



            $location = Location::get($request->ip());

            Contactus::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
                'ip_address' => $request->ip(),
                'user_agent' => $request->header('User-Agent'),
                'referrer' => $request->header('referer'),
                'country' => $location ? $location->countryName : null,
                'city' => $location ? $location->cityName : null,
            ]);

            return response()->json(['success' => 'Thank you for contacting us! We will get back to you soon.']);
        } catch (\Exception $e) {
            if ($e instanceof ValidationException) {
                // Return all validation errors
                return response()->json([
                    'errors' => $e->errors()
                ], 422);
            }

            // Any other exception
            return response()->json([
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function notifications()
    {
        $unread = Contactus::where('read_or_not', 0)->latest()->get();

        return response()->json([
            'count' => $unread->count(),
            'messages' => $unread,
        ]);
    }

    public function markAsRead($id)
    {
        $contact = Contactus::findOrFail($id);
        $contact->update(['read_or_not' => 1]);

        return response()->json(['message' => 'Marked as read']);
    }

    public function destroy(Request $request)
    {
        if (!$request->has('id')) {
            return response()->json(['error' => 'Message ID is required.'], 400);
        }

        $contact = Contactus::findOrFail($request->id);
        $contact->delete();

        return response()->json(['message' => 'Message deleted successfully.']);
    }
}
