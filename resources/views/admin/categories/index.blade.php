@extends('layouts.dashboard')

@section('main_content')
  <h2>All post categories</h2>
  <ul>
    @foreach ($categories as $category)
      <li>
        <a href="{{ route('admin.categories.show', ['slug' => $category->slug]) }}">{{ $category->name }}</a>
      </li>
    @endforeach
  </ul>
@endsection