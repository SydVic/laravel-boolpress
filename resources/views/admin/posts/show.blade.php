@extends('layouts.dashboard')

@section('main_content')
<div class="card" style="width: 40rem;">
  {{-- <img class="card-img-top" src="..." alt="Card image cap"> --}}
  <div class="card-body">
    <h5 class="card-title">{{ $post->title }}</h5>
    <p class="card-text">Slug: {{ $post->slug}}</p>
    <p class="card-text">{{ $post->content}}</p>
    <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Back to all posts</a>
    <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit this post</a>
    <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST" class="mt-3">
      @csrf
      @method('DELETE')
      <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
    </form>
  </div>
</div>
@endsection