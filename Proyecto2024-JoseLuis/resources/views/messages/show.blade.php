@extends('layout')
@section('title', 'Mensajes del Producto')
@section('content')

<section>
    <div class="container py-5">

      <div class="row d-flex justify-content-center">
        <div class="col-md-12 col-lg-10 col-xl-8">

          <div class="card" id="chat2">
            <div class="card-header d-flex justify-content-between align-items-center p-3">
                <div class="d-flex align-items-center">
                    <!-- Foto del producto -->
                    <img src="/storage/userProducts/{{ $product->name }}.png" alt="Producto" style="width: 50px; height: 50px; border-radius: 50%;">

                    <!-- Detalles del producto -->
                    <div class="ms-3">
                        <h5 class="mb-0">{{ $product->name }}</h5>
                        <p class="text-muted mb-0">Propietario: {{ $product->user->name }}</p>
                    </div>
                </div>

                <!-- Botón de chat -->
                <button type="button" data-mdb-button-init data-mdb-ripple-init class="btn btn-primary btn-sm" data-mdb-ripple-color="dark">Let's Chat App</button>
            </div>

            <div id="messageContainer" class="card-body" data-mdb-perfect-scrollbar="true" style="position: relative; max-height: 350px;min-height: 350px; overflow-y: auto;">

              @foreach ($messages as $message)
                <div class="d-flex flex-row justify-content-{{ $message->sender_id == auth()->id() ? 'end' : 'start' }} mb-4">
                    @if ($message->sender_id != auth()->id())
                        <img src="/storage/usersProfile/{{ $message->sender->name }}.png" alt="avatar" style="width: 45px; height: 100%;">
                    @endif
                    <div>
                        <p class="small p-2 {{ $message->sender_id == auth()->id() ? 'me-3 text-white' : 'ms-3 text-muted' }} mb-1 rounded-3 {{ $message->sender_id == auth()->id() ? 'bg-primary' : 'bg-light' }}">{{ $message->content }}</p>
                        <p class="small {{ $message->sender_id == auth()->id() ? 'me-3' : 'ms-3' }} mb-3 rounded-3 text-muted">{{ $message->created_at->format('H:i') }}</p>
                    </div>
                    @if ($message->sender_id == auth()->id())
                        <img src="/storage/usersProfile/{{ auth()->user()->name }}.png" alt="avatar" style="width: 45px; height: 100%;">
                    @endif
                </div>
              @endforeach

            </div>
            <div class="card-footer text-muted d-flex align-items-center p-3">
                <img src="/storage/usersProfile/{{ auth()->user()->name }}.png" alt="avatar" class="mx-2" style="width: 40px; height: 100%;">

                <!-- Formulario de envío de mensaje -->
                <form class="flex-grow-1 d-flex" action="{{ route('messages.store') }}" method="post">
                    @csrf
                    <input type="hidden" name="sender_id" value="{{ auth()->id() }}">
                    <input type="hidden" name="receiver_id" value="{{ $product->user_id }}">
                    <input type="hidden" name="user_product_id" value="{{ $product->id }}">
                    <input type="text" class="form-control form-control-lg" id="content" name="content" placeholder="Enviar mensaje">
                    <!-- Botón de enviar -->
                    <button type="submit" class="btn btn-primary ms-3"><i class="bi bi-send"></i></button>
                </form>
            </div>

          </div>

        </div>
      </div>

    </div>
  </section>
  <script>
    document.addEventListener("DOMContentLoaded", function() {
        const messageContainer = document.getElementById('messageContainer');
        messageContainer.scrollTop = messageContainer.scrollHeight;
    });
</script>

@endsection
