<!--VISTA DE LA TIENDA DE SEGUNDA MANO DONDE SE MUESTRAN LOS PRODUCTOS DE LOS USUARIOS-->
@extends('layout')
@section('title', __('Compra-Venta'))
@section('content')

    <div class="container">
        <!--INICIO DEL NAVBAR DE LOS FILTROS-->
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
                                    href="{{ route('userProducts.filterAndSort', ['category' => 'Todas las categorías']) }}">{{ __('Todas las categorías') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.filterAndSort', ['category' => 'Electrodomésticos']) }}">{{ __('Electrodomésticos') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.filterAndSort', ['category' => 'Moda y accesorios']) }}">{{ __('Moda y accesorios') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.filterAndSort', ['category' => 'Móviles']) }}">{{ __('Móviles') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.filterAndSort', ['category' => 'Muebles']) }}">{{ __('Muebles') }}</a>
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.filterAndSort', ['category' => 'Informática']) }}">{{ __('Informática') }}</a>
                            </div>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="btn nav-link"
                                href="{{ route('userProducts.filterAndSort', ['sort' => 'price_desc']) }}">{{ __('Ordenar por precio') }}
                                ({{ __('Mayor a menor') }})</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="btn nav-link"
                                href="{{ route('userProducts.filterAndSort', ['sort' => 'price_asc']) }}">{{ __('Ordenar por precio') }}
                                ({{ __('Menor a mayor') }})</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <form id="search-form" class="d-flex" action="{{ route('userProducts.filterAndSort') }}"
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
            @forelse ($userProducts as $userProduct)
                <div class="col-md-3 mb-4">
                    <div class="card store_product h-100">
                        <div class="d-flex align-items-center">
                            <!-- Mostrar la foto de perfil -->
                            <div class="profile-photo mx-1 mt-1">
                                <img src="/storage/usersProfile/{{ $userProduct->user->name }}.png" alt="Foto de perfil"
                                    class="rounded-circle" width="30" style="margin: 5px;">
                            </div>
                            <p class="card-text product-user"><strong>{{ $userProduct->user->name }}</strong></p>
                        </div>
                        <img src="/storage/userProducts/{{ $userProduct->name }}.png"
                            class="card-img-top product-image mt-4" alt="Producto">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title product-name">{{ $userProduct->name }}</h5>
                            <p class="product-description">{{ $userProduct->description }}</p>
                            <div class="d-flex justify-content-between align-items-center text-center mt-auto">
                                <p class="card-text product-price">{{ $userProduct->price }}€</p>
                                @auth
                                    @if (Auth::id() !== $userProduct->user_id)
                                        <a href="{{ route('messages.show', $userProduct) }}" class="btn btn-primary"><i
                                                class="bi bi-chat-dots"></i></a>
                                    @endif
                                @endauth
                            </div>
                            @auth
                                @if (Auth::user()->rol == 'admin')
                                    <hr>
                                    <!--INICIO POPUP ELIMINAR-->
                                    <button type="button" class="btn btn-outline-danger" data-toggle="modal"
                                        data-target="#confirmDeleteModal{{ $userProduct->id }}">
                                        <i class="bi bi-trash3"></i>
                                    </button>
                                    <div class="modal fade" id="confirmDeleteModal{{ $userProduct->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="confirmDeleteModalTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="confirmDeleteModalTitle">
                                                        ¿{{ __('Está seguro de eliminar este producto') }}?</h5>
                                                    <button type="button" class="btn-close" data-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-footer">
                                                    <form action="{{ route('userProducts.destroy', $userProduct->id) }}"
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
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            @empty
                <div class="alert alert-warning">{{ __('No hay productos disponibles.') }}</div>
            @endforelse
            <div class="pagination-wrapper">
                {{ $userProducts->links() }}
            </div>
        </div>


    </div>

@endsection
