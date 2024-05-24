<!--VISTA DONDE SE MUESTRAN TODOS LOS CHATS DEL USUARIO Y SE PUEDE ENTRAR A CADA UNO DE ELLOS-->
@extends('layout')
@section('title', __('Mensajes'))
@section('content')

    <div class="container mt-5">

        <div class="card">
            <div class="card-body">
                <h1 class="my-4 text-center chats-title">{{ __('Listado de Chats') }}</h1>
                <ul class="list-group list-group-flush">

                    @forelse($chats as $message)
                        <li class="list-group-item mb-4"
                            style="border: none; border-radius: 20px; background-color: #f0f0f0;">
                            <a href="{{ route('messages.show', $message->user_product->id) }}" class="link-message">
                                <div class="row align-items-center">
                                    <div class="col-md-1">
                                        <img src="/storage/userProducts/{{ $message->user_product->name }}.png"
                                            alt="Producto" class="chat-product-image">
                                    </div>
                                    <div class="col-md-7">
                                        <h5 class="chat-product-name">{{ $message->user_product->name }}</h5>
                                        <p class="text-muted mb-0">{{ __('Propietario') }} :
                                            {{ $message->user_product->user->name }}
                                        </p>
                                        <p class="text-muted mb-0 chat-message-content"><i
                                                class="bi bi-chat-right-dots"></i> {{ $message->content }}</p>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="text-end chat-timestamp">
                                            <strong>{{ $message->created_at->format('H:i') }}</strong>
                                        </p>
                                    </div>
                                </div>
                            </a>
                        </li>
                    @empty
                        <div class="alert alert-warning">{{ __('No hay chats disponibles.') }}</div>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>

@endsection
