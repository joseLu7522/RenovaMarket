<!--MUESTRA LOS MENSAJES DEL CHAT Y PUEDES INTERCAMBIAR MENSAJES CON EL USUARIO-->
@extends('layout')
@section('title',  __('Mensajes del Producto'))
@section('content')


    <div class="container py-5">
        <div class="row d-flex justify-content-center">
            <div class="col-md-12 col-lg-10 col-xl-8">
                <!--INICIO HEADER DEL CHAT DEL PRODUCTO-->
                <div class="card" id="chat2">
                    <div class="card-header d-flex justify-content-between align-items-center p-3">
                        <div class="d-flex align-items-center">
                            <img src="/storage/userProducts/{{ $product->name }}.png" alt="Producto"
                                class="chat-product-image">
                            <div class="ms-3">
                                <h5 class="mb-0">{{ $product->name }}</h5>
                                <p class="text-muted mb-0">{{ __('Propietario') }}: {{ $product->user->name }}</p>
                            </div>
                        </div>
                        @auth
                            @if (Auth::id() !== $product->user_id)
                                <!--POP UP DE COMPRAR EL PRODUCTO-->
                                <button class="btn btn-success ml-auto mx-2 mt-2" data-toggle="modal"
                                    data-target="#purchaseModal{{ $product->id }}">{{ __('Comprar') }}</button>
                            @endif
                        @endauth
                        <!--INICIO DE POP UP COMPRAR PRODUCTO -->
                        <div class="modal fade" id="purchaseModal{{ $product->id }}" tabindex="-1" role="dialog"
                            aria-labelledby="purchaseModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header bg-primary text-white">
                                        <h5 class="modal-title" id="purchaseModalLabel">
                                            {{ __('Datos de la Tarjeta de Crédito') }}</h5>
                                        <button type="button" class="btn-close" data-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="purchaseForm" method="POST">
                                            @csrf
                                            <div class="form-group my-1">
                                                <label
                                                    for="cardName"><strong>{{ __('Nombre del titular') }}</strong></label>
                                                <input type="text" class="form-control" id="cardName" name="cardName"
                                                    placeholder="{{ __('Nombre del titular') }}"
                                                    value="{{ Auth::user()->name }}" readonly>
                                            </div>
                                            <?php
                                            $cardNumber = str_pad(mt_rand(0, 9999999999999), 13, '0', STR_PAD_LEFT);
                                            ?><!--GENERA LOS DATOS ALEATORIAMENTE YA QUE LA PASARELA DE PAGO NO SE IMPLEMENTA VERDADERAMENTE-->
                                            <div class="form-group my-1">
                                                <label
                                                    for="cardNumber"><strong>{{ __('Número de tarjeta') }}</strong></label>
                                                <input type="text" class="form-control" id="cardNumber" name="cardNumber"
                                                    placeholder="{{ __('Número de tarjeta') }}"
                                                    value="{{ $cardNumber }}" readonly>
                                            </div>
                                            <div class="form-group my-1">
                                                <label
                                                    for="expiryDate"><strong>{{ __('Fecha de caducidad') }}</strong></label>
                                                <input type="text" class="form-control" id="expiryDate" name="expiryDate"
                                                    placeholder="MM/AA" value="02/28" readonly>
                                            </div>
                                            <?php
                                            $cvv = str_pad(mt_rand(0, 999), 3, '0', STR_PAD_LEFT);
                                            ?>
                                            <div class="form-group my-1">
                                                <label for="cvv"><strong>CVV</strong></label>
                                                <input type="text" class="form-control" id="cvv" name="cvv"
                                                    placeholder="CVV" value="{{ $cvv }}" readonly>
                                            </div>

                                            <hr>
                                            <p>{{ __('Producto') }}: {{ $product->name }}</p>
                                            <p>{{ __('Total a pagar') }}:
                                                @if (app()->getLocale() !== 'en')
                                                    {{ $product->price }}€
                                                @else
                                                    ${{ $product->price }}
                                                @endif
                                            </p>
                                        </form>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ __('Cancelar') }}</button>
                                            <form action="{{ route('userProducts.purchase', $product->id) }}"
                                                method="POST">

                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary"
                                                    id="liveAlertBtn">{{ __('Comprar') }}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--FIN DE POP UP COMPRAR PRODUCTO -->
                    </div>
                    <!--FIN HEADER DEL CHAT DEL PRODUCTO-->
                    <!-- INICIO BODY DE LOS MENSAJES , DONDE SE SACAN TODOS LOS MENSAJES ENVIADOS-->
                    <div id="messageContainer" class="card-body message-body" data-mdb-perfect-scrollbar="true">
                        @foreach ($messages as $message)
                            <div
                                class="d-flex flex-row justify-content-{{ $message->sender_id == auth()->id() ? 'end' : 'start' }}">
                                @if ($message->sender_id != auth()->id())
                                    <img src="/storage/usersProfile/{{ $message->sender->name }}.png" alt="avatar"
                                        class="message-avatar">
                                @endif
                                <div>
                                    <p
                                        class="small p-2 {{ $message->sender_id == auth()->id() ? 'me-3 text-white' : 'ms-3 text-muted' }} mb-1 rounded-3 {{ $message->sender_id == auth()->id() ? 'bg-primary' : 'bg-light' }} message-content">
                                        {{ $message->content }}
                                    </p>
                                    <p
                                        class="small {{ $message->sender_id == auth()->id() ? 'me-3' : 'ms-3' }} mb-3 rounded-3 text-muted">
                                        @if ($message->created_at->isToday())
                                            <!--SI EL MENSAJE NO ES DE HOY , INCLUIRA LA FECHA (DD Y MM) JUNTO A LA HORA-->
                                            {{ $message->created_at->format('H:i') }}
                                        @else
                                            {{ $message->created_at->format('d M, H:i') }}
                                        @endif
                                        @if ($message->sender_id == auth()->id())
                                            <span
                                                class="message-status-icon"><!--SI EL MENSAJE ESTA LEIDO PONE LOS TICKS AZULES Y SI ESTA SIN LEER LOS TICKS NORMALES-->
                                                @if ($message->read)
                                                    <i class="bi bi-check2-all text-primary"></i>
                                                @else
                                                    <i class="bi bi-check2-all text-muted"></i>
                                                @endif
                                            </span>
                                        @endif
                                    </p>
                                </div>
                                @if ($message->sender_id == auth()->id())
                                    <img src="/storage/usersProfile/{{ auth()->user()->name }}.png" alt="avatar"
                                        class="message-avatar">
                                @endif
                            </div>
                        @endforeach
                    </div>
                    <!-- INICIO BODY DE LOS MENSAJES , DONDE SE SACAN TODOS LOS MENSAJES ENVIADOS-->
                    <!--FOOTER DONDE SE ESTA EL FORMULARIO PARA ENVIAR MENSAJES-->
                    <div class="card-footer text-muted d-flex align-items-center p-3">
                        <img src="/storage/usersProfile/{{ auth()->user()->name }}.png" alt="avatar"
                            class="mx-2 message-avatar">
                        <form class="flex-grow-1 d-flex" action="{{ route('messages.store') }}" method="post">
                            @csrf
                            <input type="hidden" name="sender_id" value="{{ auth()->id() }}">
                            <input type="hidden" name="receiver_id" value="{{ $product->user_id }}">
                            <input type="hidden" name="user_product_id" value="{{ $product->id }}">
                            <input type="text" class="form-control form-control-lg" id="content" name="content"
                                placeholder="{{ __('Enviar mensaje') }}">
                            <button type="submit" class="btn btn-primary ms-3"><i class="bi bi-send"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const messageContainer = document.getElementById('messageContainer');
            messageContainer.scrollTop = messageContainer.scrollHeight;
        });
    </script>

@endsection
