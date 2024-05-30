<!--VISTA DE REGISTRO DE USUARIO-->
@extends('layout')
@section('title', __('Registrarse'))
@section('content')

    <div class="container-fluid">
        <div class="row no-gutter">
            <div class="col-md-6 d-none d-md-flex bg-image"></div>
            <div class="col-md-6 bg-light">
                <div class="login d-flex align-items-center py-5">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-xl-7 mx-auto">
                                <h3 class="display-5">{{ __('Create una cuenta!') }}</h3>
                                <p class="text-muted mb-4">{{ __('y disfruta de nuestra maravillosa comunidad.') }}</p>

                                <form action="{{ route('signup') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <input id="name" type="text" placeholder="{{ __('Nombre de usuario') }}"
                                            class="form-control rounded-pill border-0 shadow-sm px-4"
                                            value="{{ old('name') }}" name="name">
                                        @error('name')
                                            <!--ERRORES NOMBRE-->
                                            <div class="alert alert-danger mt-1 mb-1 small">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="inputEmail" type="email" placeholder="{{ __('Correo electrónico') }}"
                                            class="form-control rounded-pill border-0 shadow-sm px-4"
                                            value="{{ old('email') }}" name="email">
                                        @error('email')
                                            <!--ERRORES CORREO-->
                                            <div class="alert alert-danger mt-1 mb-1 small">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <div class="input-group position-relative">
                                            <input id="password" type="password" placeholder="{{ __('Contraseña') }}"
                                                class="form-control rounded-pill border-0 shadow-sm px-4"
                                                value="{{ old('password') }}" name="password">
                                            <button
                                                class="btn position-absolute end-0 top-50 translate-middle-y border-0 bg-transparent"
                                                type="button" id="showPasswordBtn">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </div>
                                        @error('password')
                                            <!--ERRORES CONTRASEÑA-->
                                            <div class="alert alert-danger mt-1 mb-1 small">{{ __($message) }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group mb-3">
                                        <input id="birthday" type="date"
                                            class="form-control rounded-pill border-0 shadow-sm px-4 text-primary"
                                            value="{{ old('birthday') }}" name="birthday">
                                        @error('birthday')
                                            <!--ERRORES BIRTHDAY-->
                                            <div class="alert alert-danger mt-1 mb-1 small">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="file" class="form-control rounded-pill border-0 shadow-sm px-4"
                                            id="image" name="profile_photo">
                                        <img id="previewimg" src="#" class="product-image mt-4" alt=" ">
                                        <!--ERRORES FOTO DE USUARIO-->
                                        @error('profile_photo')
                                            <div class="alert alert-danger mt-1 mb-1 small">{{ __($message) }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary btn-block text-uppercase my-2 rounded-pill shadow-sm">{{ __('CREAR CUENTA') }}</button>
                                    <div class="text-center d-flex justify-content-between mt-4">
                                        <p>{{ __('Ya tienes cuenta?') }} <a href="{{ route('loginForm') }}"
                                                class="font-italic text-muted">
                                                <u>{{ __('Iniciar sesión') }}</u></a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
