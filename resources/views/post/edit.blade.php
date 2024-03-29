@extends('layouts.app')
@section('content')

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

<form class="mb-3" action="{{route('posts.update',$post->id)}}" method="POST" enctype="multipart/form-data">
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

<div class="mb-3">
    <label for="exampleInputImage" class="form-label fs-4">Image </label><i class="text-secondary"> (Optional)</i>
    <input type="file" name="image_path" accept=".jpg,.png" class="form-control" id="exampleInputImage">
    @error('image')
        <div class="alert alert-danger my-1">{{$message}}</div>
    @enderror
</div>

  <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>
@endsection
