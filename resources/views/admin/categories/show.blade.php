@extends('layouts.dashboard')

@section('main_content')
  <h2>Post category: {{ $category->name }}</h2>
  <p>Category slug: {{ $category->slug }}</p>

  <ul>
    {{-- category ha più post collegati quindi ci restituira una collection --}}
    @forelse ($category->posts as $post)
      <li>
        <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}">{{ $post->title }}</a>
      </li>
    @empty
      <li>
        No posts available for this category
        <i class="fa-solid fa-face-frown"></i>
      </li>
    @endforelse
  </ul>

@endsection