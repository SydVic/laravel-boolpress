@extends('layouts.dashboard')

@section('main_content')

  <h2>Ciao {{ $user->name }} questa è la tua pagina di amministrazione</h2>

  @if ($user_details)
    <p>Indirizzo: {{ $user_details->address }}</p>
    <p>Telefono: {{ $user_details->phone }}</p>
  @endif

@endsection