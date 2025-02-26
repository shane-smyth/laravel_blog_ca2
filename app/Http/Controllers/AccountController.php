<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
}
