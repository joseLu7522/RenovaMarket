<!--VISTA DE LA TIENDA DONDE SE MUESTRAN TODOS LOS PRODUCTOS DE LA TIENDA-->
@extends('layout')
@section('title', __('Tienda online'))
@section('content')

    <div class="container">
        @if (session()->has('success_msg'))
            <!--MENSAJE DE PRODUCTO AÑADIDO CON EXITO-->
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ __(session()->get('success_msg')) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if (session()->has('error_msg'))
            <!-- MENSAJE DE ERROR AL AÑADIR UN PRODUCTO AL CARRITO-->
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                {{ __(session()->get('error_msg')) }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!--INICIO DEL NAVBAR DE LOS FILTROS-->
        <nav class="navbar navbar-expand-lg navbar-dark product-navbar-custom mt-5 mb-4">
            <div class="container-fluid mx-5">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavProducts"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavProducts">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown">
                            <a class="navbar-brand dropdown-toggle d-flex align-items-center" href="#"
                                id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">
                                @if (isset($selectedCategory))
                                    {{ __($selectedCategory) }}
                                @else
                                    {{ __('Categorías') }}
                                @endif
                            </a>
                            <div class="dropdown-menu dropdown-menu-center" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item {{ isset($selectedCategory) && $selectedCategory == 'Todas las categorías' ? 'active' : '' }}"
                                    href="{{ route('storeProducts.filterAndSort', ['category' => 'Todas las categorías']) }}">{{ __('Todas las categorías') }}</a>
                                <a class="dropdown-item {{ isset($selectedCategory) && $selectedCategory == 'Electrodomésticos' ? 'active' : '' }}"
                                    href="{{ route('storeProducts.filterAndSort', ['category' => 'Electrodomésticos']) }}">{{ __('Electrodomésticos') }}</a>
                                <a class="dropdown-item {{ isset($selectedCategory) && $selectedCategory == 'Moda y accesorios' ? 'active' : '' }}"
                                    href="{{ route('storeProducts.filterAndSort', ['category' => 'Moda y accesorios']) }}">{{ __('Moda y accesorios') }}</a>
                                <a class="dropdown-item {{ isset($selectedCategory) && $selectedCategory == 'Móviles' ? 'active' : '' }}"
                                    href="{{ route('storeProducts.filterAndSort', ['category' => 'Móviles']) }}">{{ __('Móviles') }}</a>
                                <a class="dropdown-item {{ isset($selectedCategory) && $selectedCategory == 'Muebles' ? 'active' : '' }}"
                                    href="{{ route('storeProducts.filterAndSort', ['category' => 'Muebles']) }}">{{ __('Muebles') }}</a>
                                <a class="dropdown-item {{ isset($selectedCategory) && $selectedCategory == 'Informática' ? 'active' : '' }}"
                                    href="{{ route('storeProducts.filterAndSort', ['category' => 'Informática']) }}">{{ __('Informática') }}</a>
                            </div>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="btn nav-link"
                                href="{{ route('storeProducts.filterAndSort', ['sort' => 'price_desc']) }}">{{ __('Ordenar por precio') }}
                                ({{ __('Mayor a menor') }})</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="btn nav-link"
                                href="{{ route('storeProducts.filterAndSort', ['sort' => 'price_asc']) }}">{{ __('Ordenar por precio') }}
                                ({{ __('Menor a mayor') }})</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <form id="search-form" class="d-flex" action="{{ route('storeProducts.filterAndSort') }}"
                            method="GET">
                            <div class="input-group">
                                <input id="search-bar" name="search" class="form-control" type="search"
                                    placeholder="{{ __('Buscar') }}" aria-label="Buscar" value="{{ request('search') }}">
                                <button id="search-button" class="btn btn-secondary" type="submit">
                                    <i class="bi bi-search"></i>
                                </button>
                            </div>
                        </form>
                    </ul>
                </div>
            </div>
        </nav>
        <!--FIN DEL NAVBAR DE LOS FILTROS-->
        <div class="row my-5" id="product-list">
            @forelse ($storeProducts as $storeProduct)
                @php
                    $isAdmin = Auth::check() && Auth::user()->rol == 'admin';
                    $isOutOfStock = $storeProduct->stock == 0;
                @endphp
                <div class="col-md-3 mb-4 product-card {{ $isOutOfStock && !$isAdmin ? 'disabled' : '' }}">
                    <div class="card store_product h-100 {{ $isOutOfStock && !$isAdmin ? 'out-of-stock' : '' }}">
                        <img src="/storage/storeProducts/{{ $storeProduct->name }}.png"
                            class="card-img-top product-image mt-4" alt="Producto">
                        <div class="card-body">
                            <h5 class="card-title product-name">{{ $storeProduct->name }}</h5>
                            <p class="product-description">{{ $storeProduct->description }}</p>

                            @auth
                                <form id="ratingForm{{ $storeProduct->id }}"
                                    action="{{ route('storeProducts.rate', $storeProduct->id) }}" method="POST">
                                    @csrf
                                    <div class="d-flex justify-content-center small text-warning my-2">
                                        @for ($i = 1; $i <= 5; $i++)
                                            <button type="submit" class="star-button"
                                                onclick="rate({{ $i }}, '{{ $storeProduct->id }}', {{ $storeProduct->id }})"
                                                {{ $isOutOfStock && !$isAdmin ? 'disabled' : '' }}>
                                                <span class="bi-star star"
                                                    id="{{ $i }}star-{{ $storeProduct->id }}"></span>
                                            </button>
                                        @endfor
                                        <input type="hidden" name="rating" id="rating{{ $storeProduct->id }}" value="0">
                                    </div>
                                </form>
                            @endauth

                            <div class="d-flex justify-content-between align-items-center text-center">
                                <p class="card-text product-stock {{ $isOutOfStock ? 'text-danger' : '' }}">
                                    {{ __('Cantidad') }}: {{ $storeProduct->stock }}
                                </p>
                                <p class="card-text product-price">
                                    @if (app()->getLocale() !== 'en')
                                        {{ $storeProduct->price }}€
                                    @else
                                        ${{ $storeProduct->price }}
                                    @endif
                                </p>
                                <form action="{{ route('cart.store') }}" method="POST">
                                    {{ csrf_field() }}
                                    <input type="hidden" value="{{ $storeProduct->id }}" id="id" name="id">
                                    <input type="hidden" value="{{ $storeProduct->name }}" id="name"
                                        name="name">
                                    <input type="hidden" value="{{ $storeProduct->price }}" id="price"
                                        name="price">
                                    <input type="hidden" value="{{ $storeProduct->description }}" id="description"
                                        name="description">
                                    <input type="hidden" value="{{ $storeProduct->image }}" id="img"
                                        name="img">
                                    <input type="hidden" value="{{ $storeProduct->stock }}" id="stock"
                                        name="stock">
                                    <input type="hidden" value="1" id="quantity" name="quantity">

                                    @auth
                                        <button type="submit" class="add-to-cart-btn mb-3"
                                            {{ $isOutOfStock && !$isAdmin ? 'disabled' : '' }}>
                                            <i class="bi bi-cart-plus-fill"></i>
                                        </button>
                                    @endauth
                                </form>
                            </div>
                            @auth
                                @if (Auth::user()->rol == 'admin')
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center text-center">
                                        <!--INICIO POPUP ELIMINAR-->
                                        <button type="button" class="btn btn-outline-danger me-2" data-toggle="modal"
                                            data-target="#confirmDeleteModal{{ $storeProduct->id }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>

                                        <div class="modal fade" id="confirmDeleteModal{{ $storeProduct->id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalTitle"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="confirmDeleteModalTitle">
                                                            ¿{{ __('Está seguro de eliminar este producto') }}?</h5>
                                                        <button type="button" class="btn-close" data-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <form action="{{ route('storeProducts.destroy', $storeProduct->id) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">{{ __('Sí') }}</button>
                                                        </form>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-dismiss="modal">{{ __('No') }}</button>
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
            @empty
                <div class="alert alert-warning">{{ __('No hay productos disponibles.') }}</div>
            @endforelse
            <div class="pagination-wrapper">
                {{ $storeProducts->links() }}
            </div>
        </div>
    </div>
    <script>
        /*SCRIPT QUE HACE LA FUNCIONA PARA PODER VALORAR UN PRODUCTO*/
        document.addEventListener("DOMContentLoaded", function() {
            /*AL CARGAR LA PAGINA SE CARGA LA PUNTUACION DE CADA PRODUCTO ALMACENADA*/
            @foreach ($storeProducts as $storeProduct)
                @if (Auth::check())
                    @php
                        $userRating = $storeProduct->users()->where('user_id', Auth::id())->first();
                        $rating = $userRating ? $userRating->pivot->rating : 0;
                    @endphp
                    for (let i = 1; i <= 5; i++) {
                        /*RECORRE EL BUCLE PARA PINTAR LAS ESTRELLAS DEPENDIENDO LA PUNTUACION*/
                        let star = document.getElementById(i + 'star-{{ $storeProduct->id }}');
                        if (i <= {{ $rating }}) {
                            star.classList.add('bi-star-fill');
                        } else {
                            star.classList.remove('bi-star-fill');
                        }
                    }
                @endif
            @endforeach
        });

        function rate(count, productId, formId) {
            document.getElementById("rating" + productId).value =
                count; /*ESTABLECE LA PUNTUACION EN UN IMPUT PARA ALMACENARLA*/

            for (let i = 1; i <= 5; i++) {
                /*SEGUN LA PUNTUACION DADA PINTARA LAS ESTRELLAS CORRESPONDIENTES*/
                let star = document.getElementById(i + 'star-' + productId);
                if (i <= count) {
                    star.classList.add('bi-star-fill');
                } else {
                    star.classList.remove('bi-star-fill');
                }
            }
        }
    </script>

@endsection
