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
  <form class="mt-3" action="{{ route('admin.posts.update', ['post' => $post_to_edit->id]) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    {{-- TITLE --}}
    <div class="mb-3">
      <label for="title" class="form-label">Title</label>
      <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ? old('title') : $post_to_edit->title }}">
    </div>
    {{-- /TITLE --}}

    {{-- CATEGORY --}}
    <div class="mb-3">
      <label for="category_id" class="form-label">Category</label>
      <select class="form-control" id="category_id" name="category_id">
        <option value="">No category</option>
        @foreach ($categories as $category)
          <option value="{{ $category->id }}" {{ $post_to_edit->category && old('category_id', $post_to_edit->category->id) == $category->id ? 'selected' : ''}}>{{ $category->name }}</option>
        @endforeach
      </select>
    </div>
    {{-- /CATEGORY --}}

    {{-- TAGS --}}
    <div class="mb-3">
      <p>Tags</p>
      @foreach ($tags as $tag)
        <div class="form-check">
          {{-- per salvare i valori multipli degli input si fa  name="tags[]" --}}
          <input class="form-check-input" type="checkbox" value="{{ $tag->id }}" id="tag-{{ $tag->id }}" name="tags[]" {{ ($post_to_edit->tags->contains($tag) || in_array($tag->id, old('tags', []))) ? 'checked' : '' }}>
          {{-- a old possiamo passare parametro di default (in questo caso array, per eviatre che se nell'old non addiamo niente ci dia errore) --}}
          <label class="form-check-label" for="tag-{{ $tag->id }}">
            {{ $tag->name }}
          </label>
        </div>
      @endforeach
    </div>
    {{-- /TAGS --}}

    {{-- CONTENT --}}
    <div class="mb-3">
      <label for="content" class="form-label">Content</label>
      {{-- TEXT area non ha attributo value quindi old() va all'interno del tag --}}
      <textarea type="text" class="form-control" id="content" name="content" rows="10">{{ old('content') ? old('content') : $post_to_edit->content }}</textarea>
    </div>
    {{-- /CONTENT --}}

    {{-- COVER IMAGE --}}
    <div class="mb-3">
      <label for="image">Change image</label>
      <input type="file" id="image" name="image">

      <h5>Current image</h5>
      @if ($post_to_edit->cover)
      <img src="{{ asset('storage/' . $post_to_edit->cover) }}" alt="{{ $post_to_edit->title }}">
      @endif
    </div>
    {{-- /COVER IMAGE --}}

    <button type="submit" class="btn btn-primary">Submit changes</button>
    <a href="{{ route('admin.posts.show', ['post' => $post_to_edit->id]) }}" class="btn btn-primary">Back without changes</a>
  </form>
  {{-- /FORM PER MODIFICA NUOVO POST --}}
@endsection