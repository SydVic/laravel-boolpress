@extends('layouts.dashboard')

@section('main_content')

  <h2>Ciao {{ $user->name }} questa è la tua pagina di amministrazione</h2>

  {{-- controlliamo se i dettagli dell'utente ci sono, altrimenti se cerchiamo di stamparli se non presenti ci darà errore --}}
  @if ($user_details)
    <p>Indirizzo: {{ $user_details->address }}</p>
    <p>Telefono: {{ $user_details->phone }}</p>
  @endif

@endsection