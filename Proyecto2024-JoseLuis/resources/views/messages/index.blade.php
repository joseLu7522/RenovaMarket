@extends('layout')

@section('title', __('Mensajes'))

@section('content')

<div class="container mt-5">

    <div class="card">
        <div class="card-body">
            <h1 class="my-4 text-center" style="font-weight: bold; color: #333;">Listado de Chats</h1>
            <ul class="list-group list-group-flush">

                @foreach($chats as $message)
                    <li class="list-group-item" style="border: none; border-radius: 20px; background-color: #f0f0f0; margin-bottom: 10px;">
                        <a href="{{ route('messages.show', $message->user_product->id) }}" style="text-decoration: none; color: inherit;">
                            <div class="row align-items-center">
                                <div class="col-md-2">
                                    <img src="/storage/userProducts/{{ $message->user_product->name }}.png" alt="Producto" style="width: 50px; height: 50px; border-radius: 50%;">
                                </div>
                                <div class="col-md-6">
                                    <h5 style="margin-bottom: 0; color: #333;">{{ $message->user_product->name }}</h5>
                                    <p class="text-muted mb-0">{{ $message->user_product->user->name }}</p>
                                    <p class="text-muted mb-0" style="font-size: 14px; color: #555;">{{ $message->content }}</p>
                                </div>
                                <div class="col-md-4">
                                    <p class="text-end" style="font-size: 12px; color: #888;"><strong>{{ $message->created_at->format('H:i') }}</strong></p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>

@endsection
