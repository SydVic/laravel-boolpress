@extends('layouts.dashboard')

@section('main_content')
  @foreach ($categories as $category)
    <li>
      <a href="">{{ $category->name }}</a>
    </li>
  @endforeach
@endsection