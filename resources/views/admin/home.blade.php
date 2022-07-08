@extends('layouts.dashboard')

@section('main_content')

  <h2>Welcome {{ $user->name }} this is your administration page</h2>

  {{-- controlliamo se i dettagli dell'utente ci sono, altrimenti se cerchiamo di stamparli se non presenti ci darà errore --}}
  {{-- @if ($user_details)
    <p>Address: {{ $user_details->address ? $user_details->address : 'not set' }}</p>
    <p>Phone: {{ $user_details->phone ? $user_details->phone : 'not set' }}</p>
  @endif --}}

  {{-- {{dd($user_details)}} --}}

  @if ($user_details->address)
    <p>Address: {{ $user_details->address }}</p>
  @else
    <a href="#">Set your details</a>
  @endif

  @if ($user_details->phone)
    <p>Phone: {{ $user_details->phone }}</p>
  @else
    <p>Phone: 
      <a href="#">Set your details</a>
    </p>
  @endif

  {{-- @foreach ($user_details as $key => $detail)
      @if ($detail)
        <p>{{ $key }}: {{ $detail }}</p>
      @else
        <p>{{ $key }}: 
          <a href="#">Set your details</a>
        </p>
      @endif
  @endforeach --}}

@endsection