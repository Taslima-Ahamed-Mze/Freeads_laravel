@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">
            <h3>Listes des annonces</h3>
        </div>
        <div class="col-sm-2">
            <a class="btn btn-success" href="/ajout">Ajouter une annonce</a>
        </div>
    </div>
    <table class="table table-hover table-sm table-bordered table-striped">
    <thead class="thead-blue">
        <tr>
            <th scope="col">Image</th>
            <th scope="col">Titre</th>
            <th scope="col">Prix</th>
            <th scope="col">Options</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ads as $ad)
            <tr>
                <td><img src="{{ URL::to('/')}}/image/{{ $ad->photographie}}" class="img-thumbnail" width="75"></td>
                <td>{{$ad->titre}}</td>
                <td>{{$ad->prix."€"}}</td>
                <td>
                <form action="{{ route('view_delete',$ad->id)}}" method="post" >

                    <a href="{{ route('view',$ad->id)}}" class="btn btn-primary">Voir</a>
                    <a href="{{ route('view_edit',$ad->id)}}" class="btn btn-warning">Editer</a>
                    @csrf
                   
                    <button class="btn btn-danger" type="submit">Supprimer</button>
                </form>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
</div>






@endsection
