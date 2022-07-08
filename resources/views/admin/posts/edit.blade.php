@extends('layouts.dashboard')

@section('main_content')

  <h2>Edit this post</h2>
  {{-- FEEDBACK ERRORI FORM PER UTENTE --}}
  @if ($errors->any())
    <div class="alert alert-danger">
      <ul>
        @foreach ($errors->all() as $error)
          <li>{{ $error }}</li>
        @endforeach
      </ul>
    </div>
  @endif
  {{-- /FEEDBACK ERRORI FORM PER UTENTE --}}

  {{-- FORM PER MODIFICA POST --}}
  <form class="mt-3" action="{{ route('admin.posts.update', ['post' => $post_to_edit->id]) }}" method="POST">
    @method('PUT')
    @csrf

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ? old('title') : $post_to_edit->title }}">
    </div>

    <div class="mb-3">
      <label for="category_id" class="form-label">Category</label>
      <select class="form-control" id="category_id" name="category_id">
        <option value="">No category</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ $post_to_edit->category && old('category_id', $post_to_edit->category->id) == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="content" class="form-label">Content</label>
      {{-- TEXT area non ha attributo value quindi old() va all'interno del tag --}}
      <textarea type="text" class="form-control" id="content" name="content" rows="10">{{ old('content') ? old('content') : $post_to_edit->content }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit changes</button>
    <a href="{{ route('admin.posts.show', ['post' => $post_to_edit->id]) }}" class="btn btn-primary">Back without changes</a>
  </form>
  {{-- /FORM PER MODIFICA NUOVO POST --}}
@endsection