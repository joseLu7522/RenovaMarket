
@extends('layout')

@section('title', 'Registrarse')

@section('content')
<div class="container-fluid">
    <div class="row no-gutter">

        <div class="col-md-6 d-none d-md-flex bg-image"></div>



        <div class="col-md-6 bg-light">
            <div class="login d-flex align-items-center py-5">


                <div class="container">
                    <div class="row">
                        <div class="col-lg-10 col-xl-7 mx-auto">
                            <h3 class="display-4">Create una cuenta!</h3>
                            <p class="text-muted mb-4">y disfruta de nuestra maravillosa comunidad.</p>
                            <form>
                                <div class="form-group mb-3">
                                    <input id="inputName" type="text" placeholder="Nombre de usuario" class="form-control rounded-pill border-0 shadow-sm px-4">
                                </div>
                                <div class="form-group mb-3">
                                    <input id="inputEmail" type="email" placeholder="Correo electrónico" class="form-control rounded-pill border-0 shadow-sm px-4">
                                </div>
                                <div class="form-group mb-3">
                                    <input id="inputPassword" type="password" placeholder="Contraseña" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                </div>
                                <div class="form-group mb-3">
                                    <input id="inputConfirmPassword" type="password" placeholder="Confirmar contraseña" class="form-control rounded-pill border-0 shadow-sm px-4 text-primary">
                                </div>
                                <div class="custom-control custom-checkbox mb-3">
                                    <input id="customCheck1" type="checkbox" checked class="custom-control-input">
                                    <label for="customCheck1" class="custom-control-label">Recordar contraseña</label>
                                </div>
                                <button type="submit" class="btn btn-primary btn-block text-uppercase mb-2 rounded-pill shadow-sm">Crear cuenta</button>
                                <div class="text-center d-flex justify-content-between mt-4"><p>Ya tienes cuenta? <a href="{{ route('loginForm') }}" class="font-italic text-muted">
                                        <u>Iniciar sesión</u></a></p></div>
                            </form>
                        </div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>
@endsection
