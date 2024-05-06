@extends('layout')

@section('title', __('Inicio'))

@section('content')
    <style>
        .profile-head {
            transform: translateY(5rem)
        }

        .cover {
            background-image: url(https://images.pexels.com/photos/110854/pexels-photo-110854.jpeg?cs=srgb&dl=pexels-miriamespacio-110854.jpg&fm=jpg);
            background-size: cover;
            background-repeat: no-repeat
        }

        body {
            background: #654ea3;
            background: linear-gradient(to right, #e96443, #904e95);
            min-height: 100vh;
            overflow-x: hidden;
        }
    </style>
    <div class="container my-5">


        <div class="bg-white shadow rounded overflow-hidden">
            <div class="px-4 pt-0 pb-4 cover">
                <div class="media align-items-end profile-head">
                    <div class="profile mr-3"><img
                            src="https://images.unsplash.com/photo-1522075469751-3a6694fb2f61?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=500&q=80"
                            alt="..." width="130" class="rounded mb-2 img-thumbnail"><a href="#"
                            class="btn btn-outline-dark btn-sm btn-block">Edit profile</a></div>
                    <div class="media-body mb-5 text-white">
                        <h4 class="mt-0 mb-0"><strong>{{ $user->name }}</strong></h4>
                        <p class="small mb-4">{{ $user->email }}</p>
                    </div>
                </div>
            </div>



            <div class="row my-5" id="product-list">
                @forelse ($user->userProducts as $product)

                <div class="col-md-3 mb-4 product-card">
                    <div class="card store_product h-100">

                        <img src="/storage/userProducts/{{ $product->name }}.png"
                            class="card-img-top product-image mt-4" alt="Producto">
                        <div class="card-body">
                            <h5 class="card-title product-name">{{ $product->name }}</h5>
                            <p class="product-description">{{ $product->description }}</p>

                            <div class="d-flex justify-content-between align-items-center text-center">

                                <p class="card-text product-price">
                                    @if (app()->getLocale() !== 'en')
                                        {{ $product->price }}€
                                    @else
                                        ${{ $product->price }}
                                    @endif
                                </p>
                            </div>
                            @auth
                            @if (Auth::id() === $user->id)
                                <hr>
                                <div class="d-flex justify-content-between align-items-center text-center">
                                    <!--INICIO POPUP ELIMINAR-->
                                    <button type="button" class="btn btn-outline-danger me-2" data-toggle="modal"
                                        data-target="#confirmDeleteModalUser{{ $product->id }}">
                                        <i class="bi bi-trash3"></i>
                                    </button>

                                    <div class="modal fade" id="confirmDeleteModalUser{{ $product->id }}"
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
                                                    <form
                                                        action="{{ route('userProducts.destroy', $product->id) }}"
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
                                    <a href="{{ route('userProducts.edit', $product->id) }}"
                                        class="btn btn-outline-secondary me-2"><i class="bi bi-pencil"></i></a>
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
    @endsection







