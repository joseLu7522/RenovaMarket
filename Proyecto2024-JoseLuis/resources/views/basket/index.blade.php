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
                                <div class="col-lg-7">
                                    <h5 class="mb-3">
                                        <a href="{{ route('storeProducts.index') }}" class="text-body link-unstyled">
                                            <i class="bi bi-arrow-left"></i> {{ __('Volver') }}
                                        </a>
                                    </h5>

                                    <hr>
                                    @if (session()->has('success_msg'))
                                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                                            {{ session()->get('success_msg') }}
                                        </div>
                                    @endif
                                    @if (session()->has('alert_msg'))
                                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                            {{ session()->get('alert_msg') }}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                    @endif
                                    @if (count($errors) > 0)
                                        @foreach ($errors0 > all() as $error)
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                {{ $error }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                        @endforeach
                                    @endif
                                    <div class="d-flex justify-content-between align-items-center mb-4">
                                        @if (\Cart::getTotalQuantity() > 0)
                                            <div>
                                                <p class="mb-1">{{ \Cart::getTotalQuantity() }} Producto(s) en el carrito
                                                </p>
                                            </div>
                                        @else
                                            <div class="text-center">
                                                <p class="mb-1">No hay productos en el carrito</p>
                                            </div>
                                        @endif
                                    </div>

                                    @foreach ($cartCollection as $item)
                                        <div class="card mb-3">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div class="d-flex flex-row align-items-center">
                                                    <div>
                                                        <img src="{{ URL::asset('storage/img/carrito/' . $item->attributes->image) }}"
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
                                                        <h5 class="mb-0">${{ $item->price }}</h5>
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



                                <div class="col-lg-5">
                                    <div class="card bg-primary text-white rounded-3">
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between align-items-center mb-4">
                                                <h5 class="mb-0">{{ __('Detalles de la tarjeta') }}</h5>
                                                <i class="bi bi-person-circle"></i>
                                            </div>
                                            <p class="small mb-2">{{ __('Tipos admitidos') }}</p>

                                            <img src="/img/Cards/visa.png" alt="Visa" class="me-2 card-icon">

                                            <img src="/img/Cards/paypal.png" alt="paypal" class="me-2 card-icon">

                                            <img src="/img/Cards/masterCard.png" alt="masterCard" class="me-2 card-icon">

                                            <form class="mt-4">
                                                <div data-mdb-input-init class="form-outline form-white mb-4">
                                                    <input type="text" id="typeName"
                                                        class="form-control form-control-lg" siez="17"
                                                        placeholder="{{ __('Nombre del titular') }}" />
                                                    <label class="form-label"
                                                        for="typeName">{{ __('Nombre del titular') }}</label>
                                                </div>
                                                <div data-mdb-input-init class="form-outline form-white mb-4">

                                                    <input type="text" id="typeText"
                                                        class="form-control form-control-lg" siez="17"
                                                        placeholder="1234 5678 9012 3456" minlength="19"
                                                        maxlength="19" />

                                                    <label class="form-label"
                                                        for="typeText">{{ __('Numero tarjeta') }}</label>
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-6">
                                                        <div data-mdb-input-init class="form-outline form-white">
                                                            <input type="text" id="typeExp"
                                                                class="form-control form-control-lg" placeholder="MM/YYYY"
                                                                size="7" id="exp" minlength="7"
                                                                maxlength="7" />

                                                            <label class="form-label"
                                                                for="typeExp">{{ __('Fecha de caducidad') }}</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div data-mdb-input-init class="form-outline form-white">
                                                            <input type="password" id="typeText"
                                                                class="form-control form-control-lg"
                                                                placeholder="&#9679;&#9679;&#9679;" size="1"
                                                                minlength="3" maxlength="3" />

                                                            <label class="form-label" for="typeText">Cvv</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </form>

                                            <hr class="my-4">

                                            <div class="d-flex justify-content-between">

                                                <p class="mb-2">{{ __('Subtotal') }}</p>

                                                <p class="mb-2">${{ \Cart::getTotal() }}</p>

                                            </div>

                                            <div class="d-flex justify-content-between">

                                                <p class="mb-2">{{ __('Envío') }}</p>

                                                <p class="mb-2">$6</p>

                                            </div>

                                            <div class="d-flex justify-content-between mb-4">

                                                <p class="mb-2">{{ __('Total') }}(Incl. IVA)</p>

                                                <p class="mb-2">${{ number_format(\Cart::getTotal() * 1.21 + 6, 2) }}
                                                </p>

                                            </div>

                                            <button type="button" data-mdb-button-init data-mdb-ripple-init
                                                class="btn btn-info btn-block btn-lg mx-auto d-block">

                                                <div class="d-flex justify-content-between align-items-center">

                                                    <span>{{ __('Realizar compra') }} <i
                                                            class="fas fa-long-arrow-alt-right ms-2"></i></span>
                                                </div>

                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>

@endsection
