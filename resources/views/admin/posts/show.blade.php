@extends('layouts.dashboard')

@section('main_content')
<div class="card" style="width: 40rem;">
  {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
  <div class="card-body">
    <h5 class="card-title">{{ $post->title }}</h5>
    <p class="card-text">Slug: {{ $post->slug}}</p>
    <p class="card-text">{{ $post->content}}</p>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Back to all posts</a>
    <a href="#" class="btn btn-primary">Edit this post</a>
    <a href="#" class="btn btn-danger">Delete</a>
  </div>
</div>
@endsection