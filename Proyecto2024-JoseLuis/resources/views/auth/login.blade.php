<!--VISTA DE INICIO DE SESION-->
@extends('layout')
@section('title', __('Iniciar sesión'))
@section('content')

    <section class="h-100 background-container">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <h4 class="mt-1 mb-5 pb-1">{{ __('INICIAR SESIÓN') }}</h4>
                                    </div>

                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="name">{{ __('Nombre de usuario') }}:</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="{{ __('Usuario') }}" value="{{ old('name') }}" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">{{ __('Contraseña') }}:</label>
                                            <div class="input-group">
                                                <input type="password" id="password" name="password" class="form-control"
                                                    placeholder="{{ __('Contraseña') }}" value="{{ old('password') }}" />
                                                <button class="btn btn-outline-secondary" type="button"
                                                    id="showPasswordBtn"><i class="bi bi-eye-slash"></i></button>
                                            </div>
                                            @if (isset($error))
                                                <div class="alert alert-danger mt-1 mb-1 small">
                                                    {{ __($error) }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="checkbox" name="remember" id="remember">
                                            <label for="remember">{{ __('Recordar inicio de sesión') }}</label>
                                        </div>

                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <input type="submit"
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                value="{{ __('Iniciar sesión') }}">
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">{{ __('¿No tienes cuenta aún?') }}</p>
                                            <a href="{{ route('signup') }}">{{ __('Registrarse') }}</a>
                                        </div>

                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center position-relative">
                                <div class="image-container">
                                    <img src="{{ asset('img/login-image.webp') }}" alt="{{ __('Imagen de registro') }}"
                                        class="img-fluid">
                                    <div class="image-overlay">
                                        <h3>{{ __('BIENVENIDO A NUESTRA COMUNIDAD!') }}</h3>
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
