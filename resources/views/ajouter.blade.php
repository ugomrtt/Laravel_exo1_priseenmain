@extends('index')
@section('section')
    <form action="ajout" method="get">

        <div class="mb-3">
            <label for="titre" class="form-label">Titre du livre</label>
            <input type="text" class="form-control" id="titre" name="titre" ariadescribedby="titre">
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Resumé</label>
            <input type="text" class="form-control" id="resume" name="resume">
        </div>
        <div class="mb-3">
        <select class="form-select" aria-label="Default select example" name="categorie_id" id="categorie_id">
        @foreach ($categories as $categorie)
            <option value="{{$categorie->id}}">{{$categorie->libelle}}</option>
        @endforeach

        </select>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix du livre</label>
            <input type="text" class="form-control" id="prix" name="prix">
        </div>

        <button type="submit" class="btn btn-primary" name="ajouter">Valider</button>
    </form>
@stop
