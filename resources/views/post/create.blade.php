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

<form class="mb-3" action="{{route('posts.store')}}" method="post" enctype="multipart/form-data">
    @csrf
  <label for="Title" class="form-label">Title</label>
  <textarea class="form-control" id="Title" name="title" rows="1"></textarea>

  <label for="Description" class="form-label">Description</label>
  <textarea class="form-control" id="Description"  name="description" rows="5"></textarea>

  
  <div>
    <label for="exampleFormControlTextarea1" class="form-label">Post Creator</label>
    <select name="post_creator" class="form-control">
        @foreach($users as $user)
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


<button type="submit" class="btn btn-primary mt-3">store</button><div class="mb-3">
</form>
@endsection
