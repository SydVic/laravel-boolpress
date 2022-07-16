@extends('layouts.dashboard')

@section('main_content')

  <div class="container-fluid">
    <h2>All posts</h2>
    <div class="container-fluid d-flex flex-wrap justify-content-center">
      @foreach ($posts as $post)
        <div class="card m-2" style="width: 30rem;">
          @if ($post->cover)
            <img src="{{ asset('storage/' . $post->cover) }}" class="card-img-top" alt="{{ $post->title }}">  
          @endif
          <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p>Slug: {{ $post->slug }}</p>
            <p class="card-text">{{ $post->content }}</p>
            <a href="{{ route('admin.posts.show', ['post' => $post->id]) }}" class="btn btn-primary">View post</a>
          </div>
        </div>
      @endforeach
    </div>
    <div class="d-flex justify-content-center">
      {{$posts->links()}}
    </div>
  </div>

@endsection