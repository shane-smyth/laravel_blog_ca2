<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        // Store data in the database
        Contact::create($request->only(['name', 'email', 'message']));

        // Redirect with success message
        return back()->with('success', 'Your message has been saved. We will get back to you soon!');
    }
}
