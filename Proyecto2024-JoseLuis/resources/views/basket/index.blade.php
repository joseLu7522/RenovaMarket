<!--VISTA DEL CARRITO DE LA COMPRA DONDE APARECEN LOS PRODUCTOS DE TU CARRITO Y LA PASARELA DE PAGO-->
@extends('layout')
@section('title', __('Carrito'))
@section('content')

    <section class="h-100 h-custom" style="background-color: #eee;">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col">
                    <div class="card">
                        <div class="card-body p-4">
                            <div class="row">
                                <!--INICIO ZONA DONDE SE VEN LOS PRODUCTOS Y LOS PUEDES MODIFICAR Y ELIMINAR-->
                                <div class="col-lg-7">
                                    <h5 class="mb-3 d-flex justify-content-between align-items-center">
                                        <a href="{{ route('storeProducts.index') }}" class="text-body link-unstyled">
                                            <i class="bi bi-arrow-left"></i> {{ __('Volver') }}
                                        </a>
                                        <form id="clear-cart-form" action="{{ route('cart.clear') }}" method="POST">
                                            @csrf
                                            <button type="submit" class="btn btn-link text-secondary">{{ __('Vaciar Carrito') }}</button>
                                        </form>
                                    </h5>

                                    <hr>
                                    @if (session()->has('success_msg'))
                                        <!--MENSAJE DE EXITO-->
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ __(session()->get('success_msg')) }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session()->has('error_msg'))
                                        <!-- MENSAJE DE ERROR AL MODIFICAR LA CANTIDAD-->
                                        <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                                            {{ __(session()->get('error_msg')) }}
                                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                aria-label="Close"></button>
                                        </div>
                                    @endif
                                    @if (session()->has('alert_msg'))
                                        <!--MENSAJE DE ELIMINAR O VACIAL EL CARRITO-->
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            {{ __(session()->get('alert_msg')) }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center mb-4">

                                        @if (\Cart::getTotalQuantity() > 0)
                                            <div>
                                                <p class="mb-1">{{ \Cart::getTotalQuantity() }}
                                                    {{ __('Producto(s) en el carrito') }}
                                                </p>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <p class="mb-1">{{ __('No hay productos en el carrito') }}</p>
                                            </div>
                                        @endif
                                    </div>

                                    @foreach ($cartCollection as $item)
                                        <div class="card mb-3">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img src="/storage/storeProducts/{{ $item->name }}.png"
                                                            class="img-fluid rounded-3" alt="Shopping item"
                                                            style="width: 65px;">

                                                    </div>
                                                    <div class="ms-3">
                                                        <h5>{{ $item->name }}</h5>
                                                        <p class="small mb-0">{{ $item->description }}</p>
                                                    </div>
                                                </div>
                                                <div class="d-flex align-items-center">
                                                    <div class="me-5">
                                                        <h5 class="mb-0">
                                                            @if (app()->getLocale() !== 'en')
                                                                {{ $item->price }}€
                                                            @else
                                                                ${{ $item->price }}
                                                            @endif
                                                        </h5>
                                                    </div>
                                                    <form action="{{ route('cart.update') }}" method="POST"
                                                        class="d-flex align-items-center">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="{{ $item->id }}" id="id"
                                                            name="id">
                                                        <input type="number" class="form-control form-control-sm me-2"
                                                            value="{{ $item->quantity }}" id="quantity" name="quantity"
                                                            style="width: 70px;" min="1">
                                                        <button type="submit" class="btn btn-sm btn-primary me-2"><i
                                                                class="bi bi-pencil-square"></i></button>
                                                    </form>
                                                    <form action="{{ route('cart.remove') }}" method="POST"
                                                        class="d-flex align-items-center">
                                                        {{ csrf_field() }}
                                                        <input type="hidden" value="{{ $item->id }}" id="id"
                                                            name="id">
                                                        <button type="submit" class="btn btn-sm btn-danger"><i
                                                                class="bi bi-trash3"></i></button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <!--FIN ZONA DONDE SE VEN LOS PRODUCTOS Y LOS PUEDES MODIFICAR Y ELIMINAR-->
                                <!--INICIO PASARELA DE PAGO-->
                                <div class="col-lg-5">
                                    <div class="card bg-primary text-white rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0">{{ __('Detalles de la tarjeta') }}</h5>

                                            </div>
                                            <p class="small mb-2">{{ __('Tipos admitidos') }}</p>

                                            <img src="/img/Cards/visa.png" alt="Visa" class="me-2 card-icon">

                                            <img src="/img/Cards/paypal.png" alt="paypal" class="me-2 card-icon">

                                            <img src="/img/Cards/masterCard.png" alt="masterCard" class="me-2 card-icon">

                                            <form class="mt-4">
                                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                                    <input type="text" id="typeName"
                                                        class="form-control form-control-lg" siez="17"
                                                        placeholder="{{ __('Nombre del titular') }}"
                                                        value="{{ Auth::user()->name }}" readonly />
                                                    <label class="form-label"
                                                        for="typeName">{{ __('Nombre del titular') }}</label>
                                                </div>
                                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                                    <?php
                                                    $cardNumber = str_pad(mt_rand(0, 9999999999999), 13, '0', STR_PAD_LEFT);
                                                    ?><!--GENERA LOS DATOS ALEATORIAMENTE YA QUE LA PASARELA DE PAGO NO SE IMPLEMENTA VERDADERAMENTE-->
                                                    <input type="text" id="typeText"
                                                        class="form-control form-control-lg" siez="17"
                                                        placeholder="1234 5678 9012 3456" minlength="19" maxlength="19"
                                                        value="{{ $cardNumber }}" readonly />

                                                    <label class="form-label"
                                                        for="typeText">{{ __('Numero tarjeta') }}</label>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <div data-mdb-input-init class="form-outline form-white">
                                                            <input type="text" id="typeExp"
                                                                class="form-control form-control-lg" placeholder="MM/YYYY"
                                                                size="7" id="exp" minlength="7"
                                                                maxlength="7" value="02/28" readonly />

                                                            <label class="form-label"
                                                                for="typeExp">{{ __('Fecha de caducidad') }}</label>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    $cvv = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
                                                    ?>
                                                    <div class="col-md-6">
                                                        <div data-mdb-input-init class="form-outline form-white">
                                                            <input type="password" id="typeText"
                                                                class="form-control form-control-lg"
                                                                placeholder="&#9679;&#9679;&#9679;" size="1"
                                                                minlength="3" maxlength="3"
                                                                value="{{ $cvv }}" readonly />

                                                            <label class="form-label" for="typeText">Cvv</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between">

                                                <p class="mb-2">{{ __('Subtotal') }}</p>

                                                <p class="mb-2">
                                                    @if (app()->getLocale() !== 'en')
                                                        {{ \Cart::getTotal() }}€
                                                    @else
                                                        ${{ \Cart::getTotal() }}
                                                    @endif
                                                </p>

                                            </div>

                                            <div class="d-flex justify-content-between">

                                                <p class="mb-2">{{ __('Envío') }}</p>

                                                <p class="mb-2">
                                                    @if (app()->getLocale() !== 'en')
                                                        6€
                                                    @else
                                                        $6
                                                    @endif
                                                </p>

                                            </div>

                                            <div class="d-flex justify-content-between mb-4">

                                                <p class="mb-2">{{ __('Total') }}({{ __('Incl. IVA') }})</p>

                                                <p class="mb-2">
                                                    @if (app()->getLocale() !== 'en')
                                                        {{ number_format(\Cart::getTotal() * 1.21 + 6, 2) }}€
                                                    @else
                                                        ${{ number_format(\Cart::getTotal() * 1.21 + 6, 2) }}
                                                    @endif
                                                </p>

                                            </div>

                                            <!-- Botón de "Realizar compra" -->
                                            <form id="complete-purchase-form" action="{{ route('orders.completePurchase') }}" method="POST">
                                                @csrf
                                                <input type="hidden" name="cartCollection" value="{{ urlencode(json_encode($cartCollection)) }}">
                                                <button type="submit" data-mdb-button-init data-mdb-ripple-init class="btn btn-info btn-block btn-lg mx-auto d-block">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <span>{{ __('Realizar compra') }}</span>
                                                    </div>
                                                </button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                <!--FIN PASARELA DE PAGO-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
