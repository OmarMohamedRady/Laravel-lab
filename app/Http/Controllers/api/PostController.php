<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    public function index(){
      $allposts = Post::paginate(2);
      return PostResource::collection($allposts);
    }

    public function show($id)
    {
        $post = Post::where('id', $id)->first();
        return new PostResource($post);

    }

    public function store(){
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        
        
        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            
            
        ]);

        return new PostResource($post);
    }
}
