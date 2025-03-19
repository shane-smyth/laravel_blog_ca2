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

    public function settings()
    {
        if (!auth()->check()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $user = auth()->user();

        if (request()->ajax()) {
            return view('account.settings', compact('user'))->render();
        }

        return redirect()->route('account');
    }


    public function updateProfile(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.auth()->id()
        ]);

        $user = auth()->user();
        $user->update($request->only('name', 'email'));

        return redirect()->route('account.settings')->with('success', 'Profile updated successfully!');
    }

    public function removeProfilePicture()
    {
        $user = auth()->user();

        if ($user->profile_picture) {
            Storage::disk('public')->delete($user->profile_picture);
            $user->profile_picture = null;
            $user->save();
        }

        return redirect()->route('account.settings')->with('success', 'Profile picture removed!');
    }


}
