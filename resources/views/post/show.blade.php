@extends('layouts.app')

@section('title') Show @endsection

@section('content')
    <div class="card mt-6">
        <div class="card-header">
            Post Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Title: {{$post['title']}}</h5>
            <p class="card-text">Description: {{$post['description']}}</p>
            <img src="{{asset('/storage/'.$post->image_path)}}" alt="err">

        
        </div>
    </div>

    <div class="card mt-6">
        <div class="card-header">
            Post Creator Info
        </div>
        <div class="card-body">
            <h5 class="card-title">Name :{{$post->user->name}} </h5>
            <h5 class="card-text">Email : {{$post->user->email}}</h5>
            <h5 class="card-text">created_at : {{$post->user->created_at}}</h5>
        </div>
    </div>

    <div class="card mt-6">
        <div class="card-header">
           Comments
        </div>
        @foreach($post->comments as $comment)
        <div class="card-body">
           
            <h5 class="card-title">Name :{{$comment->user->name}} </h5>
            <h5 class="card-text">Comment : {{$comment->body}}</h5>
            <h5 class="card-text">created_at : {{$comment->created_at-> format("Y-m-d")}}</h5>
        </div>
        @endforeach
    </div>


    <form action="{{route('comments.store', ['id'=>$post['id']])}}", method="POST">
        @csrf
        <div class="form-group">
            <textarea name="body" id="body" cols="15" rows="4" class="form-control" placeholder="Your comment here"></textarea>
        </div>
            
        <div>
            <label for="post_creator" class="form-label">Post Creator</label>
            <select name="post_creator" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>

                <br/> <br/><br/><br/>
        <div class="form-group">
            <button type="submit" class="btn btn-primary">Add Comment</button>
        </div>
    </form>

@endsection
