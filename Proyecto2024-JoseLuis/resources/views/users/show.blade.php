<!--VISTA DEL PERFIL DEL USUARIO DONDE SE MUESTRAN SUS PRODUCTOS Y DATOS-->
@extends('layout')
@section('title', __('Perfil de usuario'))
@section('content')

    <div class="container my-5">
        <div class="px-2 pt-3 pb-2 headerProfile"><!--INICIO HEADER DE PERFIL DE USUARIO-->
            <h2 class="text-center text-white fw-bold mb-4">{{ __('Perfil de usuario') }}</h2>
            <div class="media align-items-center mx-5 mb-2">
                <div class="profile mr-3">
                    <img src="/storage/usersProfile/{{ $user->name }}.png" alt="Foto de perfil" width="90"
                        class="rounded-circle mb-2">
                    <a href="{{ route('users.edit', Auth::user()->id) }}"
                        class="btn btn-editar-perfil btn-sm btn-block">{{ __('Editar perfil') }}</a>
                </div>
                <div class="media-body text-white">
                    <h4 class="mt-0 mb-1"><strong>{{ $user->name }}</strong></h4>
                    <p class="small mb-1"><i class="bi bi-cake2-fill"></i> {{ $user->birthday }}</p>
                    <p class="small mb-1"><i class="bi bi-envelope-at"></i> {{ $user->email }}</p>
                    <p class="small mb-0"><i class="bi bi-shield-lock"></i> <strong>********</strong></p>

                </div>
            </div>

            <button type="button" class="btn btn-eliminar-cuenta btn-sm" data-toggle="modal"
                data-target="#confirmDeleteModalUser{{ $user->id }}">{{ __('Eliminar cuenta') }}</button>
            <!--INICIO POP UP DE ELIMINAR CUENTA-->
            <div class="modal fade" id="confirmDeleteModalUser{{ $user->id }}" tabindex="-1" role="dialog"
                aria-labelledby="confirmDeleteModalTitle" aria-hidden="true">

                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="confirmDeleteModalTitle">
                                ¿{{ __('Está seguro de eliminar su cuenta?') }}</h5>
                            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-footer">
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('Sí, eliminar cuenta') }}</button>
                            </form>
                            <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{ __('Cancelar') }}</button>
                        </div>
                    </div>
                </div>
            </div><!--FIN POP UP DE ELIMINAR CUENTA-->
        </div><!--FIN HEADER DE PERFIL DE USUARIO-->

        <div class="row my-5" id="product-list"><!--INICIO LISTA DE PRODUCTOS DEL USUARIO-->
            @forelse ($user->userProducts as $product)
                <div class="col-md-3 mb-4 product-card">
                    <div class="card store_product h-100">

                        <img src="/storage/userProducts/{{$user->name}}/{{ $product->name }}.png" class="card-img-top product-image mt-4"
                            alt="Producto">
                        <div class="card-body">
                            <h5 class="card-title product-name">{{ $product->name }}</h5>
                            <p class="product-description">{{ $product->description }}</p>

                            <p class="card-text product-price">
                                @if (app()->getLocale() !== 'en')
                                    {{ $product->price }}€
                                @else
                                    ${{ $product->price }}
                                @endif
                            </p>

                            @auth
                                @if (Auth::id() === $user->id)
                                    <hr>
                                    <div class="d-flex justify-content-between align-items-center text-center">
                                        <!--INICIO POPUP ELIMINAR-->
                                        <button type="button" class="btn btn-outline-danger me-2" data-toggle="modal"
                                            data-target="#confirmDeleteModalUser{{ $product->id }}">
                                            <i class="bi bi-trash3"></i>
                                        </button>

                                        <div class="modal fade" id="confirmDeleteModalUser{{ $product->id }}" tabindex="-1"
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
                                                        <form action="{{ route('userProducts.destroy', $product->id) }}"
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
                <div class="alert alert-warning">{{ __('No hay productos disponibles.') }}</div>
            @endforelse
        </div><!--FIN LISTA DE PRODUCTOS DEL USUARIO-->

    @endsection
