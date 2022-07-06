@extends('layouts.dashboard')

@section('main_content')

  <div class="container">
    <h2>All posts</h2>
    <div class="container-fluid d-flex flex-wrap">
      @foreach ($posts as $post)
        <div class="card m-2" style="width: 30rem;">
          {{-- <img src="..." class="card-img-top" alt="..."> --}}
          <div class="card-body">
            <h5 class="card-title">{{$post->title}}</h5>
            <p>Slug: {{ $post->slug }}</p>
            <p class="card-text">{{ $post->content }}</p>
            <a href="#" class="btn btn-primary">Go somewhere</a>
          </div>
        </div>
      @endforeach
    </div>
  </div>

@endsection