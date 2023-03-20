@extends('layouts.app')
@section('content')


<form class="mb-3" action="{{route('posts.update',$post->id)}}" method="POST">
    @csrf
    @method("PUT");
  <label for="Title" class="form-label">Title</label>
  <textarea class="form-control" id="Title" name="title"  rows="1">{{$post->title}} </textarea>

  <label for="Description" class="form-label">Description</label>
  <textarea class="form-control" id="Description" name="description" rows="5">{{$post->description}} </textarea>

  <div>
    <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
    <select name="post_creator" class="form-control">
       
            <option value="{{$post->user->id}}">{{$post->user->name}}</option>
            @foreach($users as $user)
            @if ($post->user_id === $user->id)
            @continue
            @endif
            <option value="{{$user->id}}">{{$user->name}}</option>
        @endforeach
    </select>
</div>

  <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>
@endsection
