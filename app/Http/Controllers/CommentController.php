<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;

class CommentController extends Controller
{
    public function store(Request $request, $postId)
    {
        $request->validate([
            'content' => 'required|max:500',
        ]);

        Comment::create([
            'post_id' => $postId,
            'user_id' => auth()->user()->id,
            'content' => $request->input('content'),
        ]);

        return back()->with('message', 'Comment added successfully!');
    }

    public function destroy(Comment $comment)
    {
        // Ensure only the comment owner or post author can delete the comment
        if (auth()->user()->id === $comment->user_id || auth()->user()->id === $comment->post->user_id) {
            $comment->delete();
            return redirect()->back()->with('message', 'Comment deleted successfully.');
        }

        return redirect()->back()->with('error', 'Unauthorized action.');
    }

}
