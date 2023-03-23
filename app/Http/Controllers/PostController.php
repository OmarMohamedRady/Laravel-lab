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
    
        // $user = User::where('id', $id)->first();
//        dd($id);
        // $post =  [
        //     'id' => 3,
        //     'title' => 'Javascript',
        //     'posted_by' => 'Ali',
        //     'created_at' => '2022-08-01 10:00:00',
        //     'description' => 'hello description',
        // ];

//        dd($post);
            
        

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
        //get the form data
//        $data = request()->all();
//      
        $title = request()->title;
        $description = request()->description;
        $postCreator = request()->post_creator;
        
        // $slug = SlugService::createSlug(Post::class, 'slug', $title);
        


//        $data = $request->all();

        //insert the form data in the database
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $postCreator,
            // 'slug' => Str::slug($title),
        ]);
        // $slug = SlugService::createSlug(Post::class, 'slug', $title);
        //redirect to index route
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
        // $post = Post::find($id);
        // $user = User::where('id', $post->user_id)->first();
        
       
        // $post->title = request()->title;
        // $post->description = request()->description;
        // $user->name = request()->post_creator;
        
        // // dd( $post->user->name );
        // $post->save();
        // $user->save();
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

            Post::destroy($id);
        return redirect()->route('posts.index');
    }

    public function removeOldPosts() {
        PruneOldPostsJob::dispatch();
        return redirect()->route("posts.index");
    }
}