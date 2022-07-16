@extends('layouts.dashboard')

@section('main_content')
  <div class="card" style="width: 40rem;">
    @if ($post->cover)
      <img class="card-img-top" src="{{ asset('storage/' . $post->cover) }}" alt="{{ $post->title }}">
    @endif
    <div class="card-body">
      <h5 class="card-title">{{ $post->title }}</h5>
      {{-- per controllare se c'è o no la categoria altrimenti da errore --}}
      <p>Category: {{ $category ? $category->name : 'no-category' }}</p>
      <p class="card-text">Slug: {{ $post->slug}}</p>
      <p>Tags: 
        @forelse ($tags as $tag)
          {{ $tag->name }} {{ $loop->last ? '' : '-' }}
        @empty
            No tags for this post
        @endforelse
      </p>
      <p class="card-text">{{ $post->content}}</p>
      <a href="{{ route('admin.posts.index') }}" class="btn btn-primary">Back to all posts</a>
      <a href="{{ route('admin.posts.edit', ['post' => $post->id]) }}" class="btn btn-primary">Edit this post</a>
      {{-- da ricontrollare, se non c'è category da errore --}}
      {{-- <a href="{{ route('admin.categories.show', ['slug' => $category->slug]) }}" class="btn btn-primary">Back to posts of this category</a> --}}
      <form action="{{ route('admin.posts.destroy', ['post' => $post->id]) }}" method="POST" class="mt-3">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
      </form>
    </div>
  </div>
@endsection