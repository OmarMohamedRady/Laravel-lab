<?php

namespace App\Http\Controllers;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(){
        $id = request()->id;
        $body = request()->body;
        $postCreator = request()->post_creator;
        $post = Post::where('id', $id)->first();

        $post->comments()->create([
            'body' => $body,
            'user_id' => $postCreator,
          
        ]);
        
        return back();

    }
}
