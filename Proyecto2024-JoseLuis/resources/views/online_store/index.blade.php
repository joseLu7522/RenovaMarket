@extends('layout')

@section('title', __('Tienda online'))

@section('content')

<div class="container">
    <nav class="navbar navbar-expand-lg navbar-dark product-navbar-custom mt-5 mb-4">
        <div class="container-fluid mx-5">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">

                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="navbar-brand dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            {{ __('Categorías') }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item"
                                href="{{ route('storeProducts.index') }}">{{ __('Todas las categorías') }}</a>
                            <a class="dropdown-item"
                                href="{{ route('storeProducts.filter', 'Electrodomésticos') }}">{{ __('Electrodomésticos') }}</a>
                            <a class="dropdown-item"
                                href="{{ route('storeProducts.filter', 'Moda y accesorios') }}">{{ __('Moda y accesorios') }}</a>
                            <a class="dropdown-item"
                                href="{{ route('storeProducts.filter', 'Móviles') }}">{{ __('Móviles') }}</a>
                            <a class="dropdown-item"
                                href="{{ route('storeProducts.filter', 'Muebles') }}">{{ __('Muebles') }}</a>
                            <a class="dropdown-item"
                                href="{{ route('storeProducts.filter', 'Informática') }}">{{ __('Informática') }}</a>
                        </div>
                    </li>
                    <li class="nav-item mx-3">
                        <button class="btn nav-link" id="sort-high-to-low">{{ __('Ordenar por precio') }}
                            ({{ __('Mayor a menor') }})</button>
                    </li>
                    <li class="nav-item mx-3">
                        <button class="btn nav-link" id="sort-low-to-high">{{ __('Ordenar por precio') }}
                            ({{ __('Menor a mayor') }})</button>
                    </li>
                </ul>
                <ul class="navbar-nav">
                    <form class="d-flex">
                        <input id="search-bar" class="form-control mx-3" type="search"
                            placeholder={{ __('Buscar') }} aria-label="Buscar">
                    </form>
                </ul>
            </div>
        </div>
    </nav>
    <div class="row my-5" id="product-list">
        @forelse ($storeProducts as $storeProduct)
        @if ($storeProduct->stock > 0 || (Auth::check() && Auth::user()->rol == 'admin'))
        <div class="col-md-3 mb-4 product-card">
            <div class="card store_product {{ $storeProduct->stock == 0 ? 'out-of-stock' : '' }}">
                <img src="{{ asset('/img/prueba.jpg') }}" class="card-img-top product-image mt-4" alt="Producto">
                <div class="card-body">
                    <h5 class="card-title product-name">{{ $storeProduct->name }}</h5>
                    <p class="product-description">{{ $storeProduct->description }}</p>

                    <div class="d-flex justify-content-center small text-warning my-2">
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                        <div class="bi-star-fill"></div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center text-center">

                        <p class="card-text product-stock">Stock: {{ $storeProduct->stock }}</p>

                        <p class="card-text product-price">{{ $storeProduct->price }}€</p>
                        <form action="{{ route('basket.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $storeProduct->id }}">
                            <button type="submit" class="add-to-cart-btn mb-3">
                                <i class="bi bi-cart-plus-fill"></i>
                            </button>
                        </form>
                    </div>
                    @auth
                    @if (Auth::user()->rol == 'admin')
                    <hr>
                    <div class="d-flex justify-content-between align-items-center text-center">
                        <!--INICIO POPUP ELIMINAR-->
                        <button type="button" class="btn btn-outline-danger me-2" data-toggle="modal"
                            data-target="#confirmDeleteModal">
                            <i class="bi bi-trash3"></i>
                        </button>
                        <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="confirmDeleteModalTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalTitle">¿Está seguro de
                                            eliminar este producto?</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{ route('storeProducts.destroy', $storeProduct->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Sí</button>
                                        </form>
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--FIN POPUP ELIMINAR-->
                        <a href="{{ route('storeProducts.edit', $storeProduct->id) }}"
                            class="btn btn-outline-secondary me-2"><i class="bi bi-pencil"></i></a>
                    </div>
                    @endif
                    @endauth
                </div>
            </div>
        </div>
        @endif
        @empty
        <div class="alert alert-warning">No hay productos disponibles.</div>
        @endforelse
    </div>
</div>
<script src="/js/search.js"></script>

@endsection
