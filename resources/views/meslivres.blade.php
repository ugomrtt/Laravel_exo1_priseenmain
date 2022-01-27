@extends('index')
@section('section')

<h2>Liste de tous les livres</h2>

<table class="table table-dark table-striped">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Titre</th>
        <th scope="col">Résumé</th>
        <th scope="col">Catégorie</th>
        <th scope="col">Prix</th>
        <th scope="col">Gérer</th>
      </tr>
    </thead>

    <tbody>
        @foreach($livres as $livre)
      <tr>
        <td>{{$livre->id}}</td>
        <td>{{$livre->titre}}</td>
        <td>{{$livre->resume}}</td>
        <td>{{$livre->libelle}}</td>
        <td>{{$livre->prix}} €</td>
        <td style="display: flex;">
          <form action="modifier" method="get">
            <button type="submit" class="btn btn-warning">Modifier</button>
            <input type="hidden" value="{{$livre->id}}" name="id">
          </form>
          <form action="delete" method="get">
            <input type="hidden" value="{{$livre->id}}" name="id">
            <button type="submit" class="btn btn-danger" name="delete">Supprimer</button></td>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

@endsection