@extends('layout')

@section('title', __('Tienda online'))

@section('content')


    <style>
        .product-card {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        }

        .product-image {
            height: 300px;
            object-fit: cover;
            width: 100%;
            transition: transform 0.5s;
        }


        .product-image:hover {
            transform: scale(0.9);
        }

        .product-name {
            font-weight: bold;
            text-align: center;
            font-size: 18px;
            margin-bottom: 10px;
        }


        .product-price {
            font-size: 25px;
            font-weight: bold;
            text-align: center;
        }

        .product-description {
            font-size: 14px;
            color: #6c757d;
            margin-bottom: 10px;
            text-align: center;
        }

        .add-to-cart-btn {
            background-color: transparent;
            border: none;
            color: #007bff;
            cursor: pointer;
            transition: color 0.3s;
        }

        .add-to-cart-btn:hover {
            color: #0056b3;
        }

        .bi-cart-plus-fill {
            font-size: 25px;
        }
    </style>

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark navbar-custom mt-5 mb-4">
            <div class="container-fluid mx-5">
                <a class="navbar-brand" href="{{ route('home') }}">{{ __('Categorias :') }}</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('storeProducts.index') }}">{{ __('Todas') }}</a>
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
                        <form class="d-flex">
                            <input class="form-control mx-3" type="search" placeholder="Buscar" aria-label="Buscar">
                            <button class="btn btn-outline-success" type="submit">Buscar</button>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row my-5">
            @forelse ($storeProducts as $product)
                <div class="col-md-3">
                    <div class="card product-card">
                        <img src="{{ asset('/img/prueba.jpg') }}" class="card-img-top product-image mt-4" alt="Producto">
                        <div class="card-body">
                            <h5 class="card-title product-name">{{ $product->name }}</h5>
                            <p class="product-description">{{ $product->description }}</p>

                            <div class="d-flex justify-content-center small text-warning my-2">
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                                <div class="bi-star-fill"></div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">

                                <p class="card-text">Stock: {{ $product->stock }}</p>

                                <p class="card-text product-price">{{ $product->price }}€</p>
                                <button class="add-to-cart-btn">
                                    <i class="bi bi-cart-plus-fill"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">No hay productos disponibles.</div>
            @endforelse
        </div>
    </div>

@endsection
