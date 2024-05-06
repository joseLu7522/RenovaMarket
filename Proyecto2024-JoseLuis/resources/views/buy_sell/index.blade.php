@extends('layout')

@section('title', __('Compra-Venta'))

@section('content')
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark product-navbar-custom mt-5 mb-4">
            <div class="container-fluid mx-5">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavUserProducts"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavUserProducts">

                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="navbar-brand dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ __('Categorías') }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.index') }}">{{ __('Todas las categorías') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.filter', 'Electrodomésticos') }}">{{ __('Electrodomésticos') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.filter', 'Moda y accesorios') }}">{{ __('Moda y accesorios') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.filter', 'Móviles') }}">{{ __('Móviles') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.filter', 'Muebles') }}">{{ __('Muebles') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.filter', 'Informática') }}">{{ __('Informática') }}</a>
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
                            <input id="search-bar" class="form-control mx-3" type="search" placeholder={{ __('Buscar') }}
                                aria-label="Buscar">
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="row my-5" id="product-list">
            @forelse ($userProducts as $userProduct)
                <div class="col-md-3 mb-4 product-card">
                    <div class="card store_product">
                        <p class="card-text product-user">Usuario: {{ $userProduct->user->name }}</p>
                        <img src="/storage/userProducts/{{ $userProduct->name }}.png"
                                class="card-img-top product-image mt-4" alt="Producto">
                        <div class="card-body">
                            <h5 class="card-title product-name">{{ $userProduct->name }}</h5>
                            <p class="product-description">{{ $userProduct->description }}</p>

                            <div class="d-flex justify-content-between align-items-center text-center">

                                <p class="card-text product-price">{{ $userProduct->price }}€</p>

                                <button type="submit" class="add-to-cart-btn mb-3">
                                    <i class="bi bi-cart-plus-fill"></i>
                                </button>

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
                                                        <h5 class="modal-title" id="confirmDeleteModalTitle">¿Está seguro
                                                            de
                                                            eliminar este producto?</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('userProducts.destroy', $userProduct->id) }}"
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
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>

            @empty
                <div class="alert alert-warning">No hay productos disponibles.</div>
            @endforelse
        </div>
    </div>
    <script src="/js/search.js"></script>

@endsection

