@extends('layouts.app')
@section('content')


<form class="mb-3" action="{{route('posts.store')}}" method="post">
    @csrf
  <label for="Title" class="form-label">Title</label>
  <textarea class="form-control" id="Title" rows="3"></textarea>

  <label for="Description" class="form-label">Description</label>
  <textarea class="form-control" id="Description" rows="3"></textarea>

  <label for="Post Creator" class="form-label">Post Creator</label>
  <textarea class="form-control" id="Post Creator" rows="3"></textarea>
  <button type="submit" class="btn btn-primary mt-3">store</button>
</form>
@endsection
