<!--VISTA DEL ERROR 404-->
@extends('layout')
@section('title', __('Error 404'))
@section('content')

<div class="container">
    <div class="error-container text-center my-5">
        <img src="{{ asset('img/errors/404.png') }}" class="error-image img-fluid error404" alt="Error 404">
        <h1 class="display-4">¡Oops!</h1>
        <p class="lead">{{ __('Lo sentimos, la página que estás buscando no pudo ser encontrada.') }}</p>
        <a href="{{ url('/') }}" class="btn btn-primary">{{ __('Ir a la página principal') }}</a>
    </div>
</div>

@endsection
