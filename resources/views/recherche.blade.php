@extends('index')
@section('section')

<h2>Résultats de la recherche</h2>

@if(count($livres) == 0)
    <p>Aucun Livre trouvé</p>

@else

<table class="table">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Titre</th>
        <th scope="col">Résumé</th>
        <th scope="col">prix</th>
      </tr>
    </thead>

    <tbody>
        @foreach($livres as $livre)
      <tr>
        <th>{{$livre->id}}</th>
        <th>{{$livre->titre}}</th>
        <th>{{$livre->resume}}</th>
        <th>{{$livre->prix}} €</th>

      </tr>
      @endforeach
    </tbody>
  </table>

  @endif
@endsection