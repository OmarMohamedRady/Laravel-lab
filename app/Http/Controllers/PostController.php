<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use \Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Support\Str;
use App\Jobs\PruneOldPostsJob;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $allPosts = Post::paginate(10);
        
       

        return view('post.index', ['posts' => $allPosts]);
    }

    public function show($id)
    {
        // dd($id);
        $id2 = request()->id;
        $post = Post::where('id', $id)->first();
        // dd($post);
        $allUsers = User::all();
    
    
            
        

        return view('post.show', ['post' => $post],['users'=>$allUsers]);
    }


    public function create()
    {
     
        $users = User::all();
        // dd($users[0]['name']);
        return view('post.create',['users'=>$users]);
    }

    public function store(StorePostRequest $request)
    {
       
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        
        
        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            
            
        ]);

       
        if ($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $filename = $image->getClientOriginalName();
            $path = Storage::putFileAs('posts', $image, $filename);
            $post->image_path = $path;
            $post->save();
        }
       
        return to_route('posts.index');
    }

    public function edit($id)
    {
            
        $post = Post::where('id', $id)->first();
        $users =User::all();
        return view('post.edit' ,['post' => $post],['users'=>$users]);
    }
    public function update(UpdatePostRequest $request,$id)
    {
        
        $post = Post::findOrFail($id);

        if ($request->hasFile('image_path')) {
            if ($post->image_path) {
                Storage::delete($post->image_path);
            }
            $image = $request->file('image_path');
            $filename = $image->getClientOriginalName();
            $path = Storage::putFileAs('posts', $image, $filename);
            $post->image_path = $path;
            $post->save();
        }



        $title=request()->title;
        $description=request()->description;
        $postCreator=request()->post_creator;
        Post::where('id',$id)
            ->update([
            'title'=>$title,
            'description'=>$description,
            'user_id'=>$postCreator,
            'slug' => Str::slug($title),
        ]);
        // 
        return redirect()->route('posts.index');
    }

    public function destroy($id){

            // Post::destroy($id);
        $post = Post::findOrFail($id);
        Post::where('id', $id)->delete();
        Storage::delete($post->image_path);
        return redirect()->route('posts.index');
    }

    public function removeOldPosts() {
        PruneOldPostsJob::dispatch();
        return redirect()->route("posts.index");
    }
}