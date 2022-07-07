@extends('layouts.dashboard')

@section('main_content')

  <h2>Create a new post</h2>
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

  {{-- FORM PER CREAZIONE NUOVO POST --}}
  <form class="mt-3" action="{{ route('admin.posts.store') }}" method="POST">
    @csrf

    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
    </div>

    <div class="mb-3">
      <label for="category_id" class="form-label">Category</label>
      <select class="form-control" id="category_id" name="category_id">
        <option value="">No category</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="content" class="form-label">Content</label>
      {{-- TEXT area non ha attributo value quindi old() va all'interno del tag --}}
      <textarea type="text" class="form-control" id="content" name="content" rows="10">{{ old('content') }}</textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  {{-- /FORM PER CREAZIONE NUOVO POST --}}

@endsection