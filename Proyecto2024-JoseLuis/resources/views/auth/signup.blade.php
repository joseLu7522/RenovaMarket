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
                                <h3 class="display-5">Create una cuenta!</h3>
                                <p class="text-muted mb-4">y disfruta de nuestra maravillosa comunidad.</p>

                                <form action="{{ route('signup') }}" method="post" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group mb-3">
                                        <input id="name" type="text" placeholder="Nombre de usuario"
                                            class="form-control rounded-pill border-0 shadow-sm px-4"
                                            value="{{ old('name') }}" name="name">
                                        @error('name')
                                            <!--ERRORES NOMBRE-->
                                            <div class="alert alert-danger mt-1 mb-1 small">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="inputEmail" type="email" placeholder="Correo electrónico"
                                            class="form-control rounded-pill border-0 shadow-sm px-4"
                                            value="{{ old('email') }}" name="email">
                                        @error('email')
                                            <!--ERRORES CORREO-->
                                            <div class="alert alert-danger mt-1 mb-1 small">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="inputPassword" type="password" placeholder="Contraseña"
                                            class="form-control rounded-pill border-0 shadow-sm px-4"
                                            value="{{ old('password') }}" name="password">
                                        @error('password')
                                            <!--ERRORES CONTRASEÑA-->
                                            <div class="alert alert-danger mt-1 mb-1 small">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input id="birthday" type="date"
                                            class="form-control rounded-pill border-0 shadow-sm px-4 text-primary"
                                            value="{{ old('birthday') }}" name="birthday">
                                        @error('birthday')
                                            <!--ERRORES BIRTHDAY-->
                                            <div class="alert alert-danger mt-1 mb-1 small">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-3">
                                        <input type="file" class="form-control rounded-pill border-0 shadow-sm px-4" id="profile_photo" name="profile_photo">
                                        <img id="previewimg" src="#" class="product-image mt-4" alt=" ">
                                        <!--ERRORES FOTO DE USUARIO-->
                                        @error('profile_photo')
                                            <div class="alert alert-danger mt-1 mb-1 small">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <button type="submit"
                                        class="btn btn-primary btn-block text-uppercase my-2 rounded-pill shadow-sm">Crear
                                        cuenta</button>
                                    <div class="text-center d-flex justify-content-between mt-4">
                                        <p>Ya tienes cuenta? <a href="{{ route('loginForm') }}"
                                                class="font-italic text-muted">
                                                <u>Iniciar sesión</u></a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    <script>
        profile_photo.onchange = evt => {
      const [file] = profile_photo.files
      if (file) {
        previewimg.src = URL.createObjectURL(file)
      }
    }
    </script>
@endsection
