<!--VISTA DEL FORMULARIO INICIO DE SESION-->
@extends('layout')

@section('title', 'Iniciar sesión')

@section('content')
    <section class="h-100 gradient-form background-container">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-xl-10">
                    <div class="card rounded-3 text-black">
                        <div class="row g-0">
                            <div class="col-lg-6">
                                <div class="card-body p-md-5 mx-md-4">

                                    <div class="text-center">
                                        <img src="https://brandlogos.net/wp-content/uploads/2021/01/la-liga-logo.png"
                                            style="width: 185px;" alt="logo">
                                        <h4 class="mt-1 mb-5 pb-1">INICIAR SESIÓN</h4>
                                    </div>

                                    <form action="{{ route('login') }}" method="post">
                                        @csrf
                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="name">Nombre de usuario:</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                placeholder="Usuario" value="{{ old('name') }}" />
                                        </div>

                                        <div class="form-outline mb-4">
                                            <label class="form-label" for="password">Contraseña:</label>
                                            <input type="password" id="password" name="password" class="form-control"
                                                placeholder="Contraseña" value="{{ old('password') }}" />
                                            @if (isset($error))
                                                <div class="alert alert-danger mt-1 mb-1 small">
                                                    {{ $error }}
                                                </div>
                                            @endif
                                        </div>

                                        <div class="form-outline mb-4">
                                            <input type="checkbox" name="remember" id="remember">
                                            <label for="remember">Recordar login</label>
                                        </div>

                                        <div class="text-center pt-1 mb-3 pb-1">
                                            <input type="submit"
                                                class="btn btn-primary btn-block fa-lg gradient-custom-2 mb-3"
                                                value="Iniciar sesión">
                                        </div>
                                        <div class="text-center pt-3 mb-5">
                                            <a href="{{ route('home') }}"
                                                class="btn btn-primary btn-block btn-lg mt-3 d-flex align-items-center justify-content-center">
                                                <img src="/img/logo_Favicon/google.png" alt="google"
                                                    class="me-4 google-icon">
                                                Inicia sesión con google
                                            </a>
                                        </div>

                                        <div class="d-flex align-items-center justify-content-center pb-4">
                                            <p class="mb-0 me-2">¿No tienes cuenta aún?</p>
                                            <a href="{{ route('signup') }}">Registrarse</a>
                                        </div>


                                    </form>

                                </div>
                            </div>
                            <div class="col-lg-6 d-flex align-items-center gradient-custom-2">
                                <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                    <h4 class="mb-4">Juntos hacia la victoria</h4>
                                    <p class="small mb-0">La Liga de Fútbol es una entidad apasionante que trasciende más
                                        allá de ser simplemente una competición deportiva. Es un emocionante escenario donde
                                        los mejores equipos y jugadores se enfrentan en intensos partidos para alcanzar la
                                        gloria.</p>
                                    <p class="small mb-0">La liga se ha convertido en un símbolo de excelencia y rivalidad,
                                        atrayendo a fanáticos de todo el mundo. Su historia rica y emocionante ha visto el
                                        surgimiento de leyendas del fútbol y momentos inolvidables. Los equipos compiten no
                                        solo por el título, sino también por el orgullo y la admiración de sus seguidores.
                                    </p>
                                    <p class="small mb-0">La Liga de Fútbol es un fenómeno global que fusiona la destreza
                                        atlética con la pasión de los aficionados, creando una experiencia única que
                                        trasciende las fronteras culturales y lingüísticas. En este escenario vibrante, cada
                                        temporada se teje una narrativa única llena de emoción, sorpresas y hazañas
                                        deportivas.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
