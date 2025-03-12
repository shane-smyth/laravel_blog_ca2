<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User; // Add this line to import the User model

class AccountController extends Controller {
    public function index(){
        $user = auth()->user();
        return view('account.index', compact('user'));
    }

    public function uploadProfilePicture(Request $request){
        $request->validate([
            'profile_picture' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = auth()->user();
        if ($request->hasFile('profile_picture')) {
            $file = $request->file('profile_picture');
            $path = $file->store('profile_pictures', 'public');
            $user->profile_picture = $path;
            $user->save();
        }

        return redirect()->route('account')->with('success', 'Profile picture updated successfully.');
    }

    public function show($id) {
        $user = User::with('posts')->findOrFail($id);

        // If viewing own profile, redirect to private view
        if(auth()->check() && auth()->id() == $user->id) {
            return redirect()->route('account');
        }

        return view('account.show', compact('user'));
    }

    public function settings() {
        return view('account.settings'); // You'll need to create this view later
    }
}
