<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Message;

class ContactController extends Controller
{
	public function index()
    {
        // Retrieve messages in descending order with pagination
        $messages = Message::orderBy('created_at', 'desc')->paginate(10);
        return view('dashboard.messages.index', compact('messages'));
    }
    public function create()
    {
        // Return a view with the contact form
        return view('contact.create'); 
    }

    public function store(Request $request)
    {
        // Advanced validation: require either email or phone along with strict validations.
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|required_without:phone',
            'phone'   => 'nullable|string|required_without:email|regex:/^\+?[0-9]{1,15}$/',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ], [
            'email.required_without' => 'Either email or phone is required.',
            'phone.required_without' => 'Either phone or email is required.',
        ]);
        
        // Wrap creation in a transaction (advanced structure)
        \DB::transaction(function () use ($validated) {
            Message::create($validated);
            // ...additional logic (e.g., sending an email)...
        });

        return redirect()->route('contact')->with('success', 'Message sent successfully!');
    }
}