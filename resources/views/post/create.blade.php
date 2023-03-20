@extends('layouts.app')
@section('content')


<form class="mb-3" action="{{route('posts.store')}}" method="post">
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
<button type="submit" class="btn btn-primary mt-3">store</button><div class="mb-3">
</form>
@endsection
