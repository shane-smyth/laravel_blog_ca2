<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        $like = $post->likes()->create([
            'user_id' => auth()->id()
        ]);

        return response()->json([
            'count' => $post->fresh()->likes()->count(),
            'liked' => true
        ]);
    }

    public function destroy(Post $post)
    {
        $post->likes()->where('user_id', auth()->id())->delete();

        return response()->json([
            'count' => $post->fresh()->likes()->count(),
            'liked' => false
        ]);
    }
}
