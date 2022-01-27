@extends('index')
@section('section')
    <form action="modif" method="get">

        <div class="mb-3">
            <label for="titre" class="form-label">Titre du livre</label>
            <input type="text" class="form-control" id="titre" name="titre" ariadescribedby="titre" value="{{$livre->titre}}">
        </div>

        <div class="mb-3">
            <label for="resume" class="form-label">Resumé</label>
            <input type="text" class="form-control" id="resume" name="resume" value="{{$livre->resume}}">
        </div>
        <div class="mb-3">
            <label for="categorie" class="form-label">Catégorie</label>
            <select class="form-select" aria-label="Default select example" name="categorie_id" id="categorie_id">
            @foreach ($categories as $categorie)
                @if($livre->categorie_id == $categorie->id)
                    <option selected value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                @else
                <option value="{{$categorie->id}}">{{$categorie->libelle}}</option>
                @endif
            @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="prix" class="form-label">Prix du livre</label>
            <input type="text" class="form-control" id="prix" name="prix" value="{{$livre->prix}}">
        </div>

        <input type="hidden" value="{{$livre->id}}" name="id">

        <button type="submit" class="btn btn-primary" name="modif">Modifier</button>
    </form>
@stop
