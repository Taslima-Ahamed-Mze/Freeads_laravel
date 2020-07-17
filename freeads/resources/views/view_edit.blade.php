@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Editer cette annonce') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{route('view_update',$data->id)}}" enctype="multipart/form-data">
                        @csrf
                        <!-- @method('PATCH') -->

                        <div class="form-group row">
                            <label for="titre" class="col-md-4 col-form-label text-md-right">{{ __('Titre') }}</label>

                            <div class="col-md-6">
                                <input id="titre" type="text" class="form-control @error('titre') is-invalid @enderror" name="titre" value="{{$data->titre}}"  required autocomplete="titre" autofocus>

                                @error('titre')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <textarea id="description"  class="form-control @error('description') is-invalid @enderror" name="description"  required autocomplete="description">{{$data->description}}</textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="photographie" class="col-md-4 col-form-label text-md-right">{{ __('Photographie') }}</label>

                            <div class="col-md-6">
                                <input id="photographie"   type="file" class="form-control @error('photographie') is-invalid @enderror" name="photographie" >
                                <img src="{{ URL::to('/')}}/image/{{ $data->photographie}}" class="img-thumbnail" widht="100" >
                                <input type="hidden" name="hidden_image" value="{{$data->photographie}}">
                                @error('photographie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="prix" class="col-md-4 col-form-label text-md-right">{{ __('Prix') }}</label>

                            <div class="col-md-6">
                                <input id="prix" type="text" class="form-control" name="prix" value="{{$data->prix}}" required autocomplete="new-prix">
                            </div>
                        </div>
                        @error('prix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Modifier') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
