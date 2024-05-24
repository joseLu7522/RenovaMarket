<!--VISTA DE LA PAGINA PARA EDITAR NUESTRO USUARIO-->
@extends('layout')
@section('title', 'Editar perfil')
@section('content')

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card background-container">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">{{ __('Editar perfil') }}</h1>
                        <form action="{{ route('users.update', $user->id) }}" method="POST" class="needs-validation"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $user->name }}">
                                <!--ERRORES DEL NOMBRE-->
                                @error('name')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ __($message) }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">{{ __('Correo electrónico') }}</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    value="{{ $user->email }}">
                                <!--ERRORES DEL CORREO ELECTRÓNICO-->
                                @error('email')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ __($message) }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="birthday" class="form-label">{{ __('Fecha de cumpleaños') }}</label>
                                <input type="date" class="form-control" id="birthday" name="birthday"
                                    value="{{ $user->birthday }}">
                                <!--ERRORES DEL CUMPLEAÑOS-->
                                @error('birthday')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ __($message) }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">{{ __('Contraseña') }}</label>
                                <div class="input-group">
                                    <input type="password" class="form-control" id="password" name="password">
                                    <button class="btn btn-outline-secondary" type="button" id="showPasswordBtn"><i
                                            class="bi bi-eye-slash"></i></button>
                                </div>
                                <!--ERRORES DE LA CONTRASEÑA-->
                                @error('password')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ __($message) }}
                                    </div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="image" class="form-label">{{ __('Imagen') }}</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <img id="previewimg" src="#" class="product-image mt-4" alt=" ">

                                <!--ERRORES IMAGEN-->
                                @error('image')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ __($message) }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">{{ __('Guardar cambios') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
