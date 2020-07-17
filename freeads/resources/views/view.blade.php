@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        
        <div class="col-md-12">
        <div class="card">
                <!-- <div class="card-header">Dashboard</div> -->

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ ('Mes annonces') }}
                    <br>
                    <img src="{{ URL::to('/')}}/image/{{ $data->photographie}}" class="img-thumbnail" width="400" >
                    <h3>Titre - {{ $data->titre}}</h3>
                    <h3>Prix - {{ $data->prix}}</h3>
                    <p>{{ $data->description}}</p>

                    </div>
            </div>
        </div>
    </div>
</div>
                    
                    
                
@endsection
