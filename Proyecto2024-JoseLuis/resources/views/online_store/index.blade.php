@extends('layout')

@section('title', __('Tienda online'))

@section('content')


    <style>

.product-card {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .product-image {
        height: 200px; /* Altura deseada */
        object-fit: cover; /* Para ajustar la imagen dentro del contenedor sin deformarla */
        width: 100%; /* Ancho completo */
    }

    .product-name {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .product-details {
        margin-top: 10px;
    }

    .product-price {
        font-size: 16px;
    }

    .add-to-cart-btn {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 8px 16px;
        border-radius: 5px;
        cursor: pointer;
    }

    .add-to-cart-btn:hover {
        background-color: #0056b3;
    }

    </style>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mt-5 mb-4">
            <div class="container-fluid mx-5">
                <a class="navbar-brand" href="{{ route('home') }}"><i class="bi bi-house-door-fill"></i> {{ __('Inicio') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('shop') }}">{{ __('Tienda online') }}</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('Compra-venta') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('Subir producto') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('home') }}">{{ __('CONTACTO') }}</a>
                            </li>

                        @endauth

                    </ul>
                    <ul class="navbar-nav">
                        @auth
                            <a class="nav-link" href="#">
                                <i class="bi bi-cart4"></i>
                            </a>


                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row">
            @for ($i = 1; $i <= 4; $i++)
                <div class="col-md-3">
                    <div class="card product-card">
                        <img src="{{ asset('ruta/a/tu/imagen'.$i.'.jpg') }}" class="card-img-top product-image"
                            alt="Producto {{ $i }}">
                        <div class="card-body">
                            <h5 class="card-title product-name">Producto {{ $i }}</h5>
                            <div class="product-details">
                                <p class="card-text product-price">${{ $i }}00</p>
                                <p class="card-text">Stock: {{ rand(0, 100) }}</p> <!-- Ejemplo de stock aleatorio -->
                            </div>
                            <button class="add-to-cart-btn">Añadir al carrito</button>
                        </div>
                    </div>
                </div>
            @endfor
        </div>
    </div>




@endsection
