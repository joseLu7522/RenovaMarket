<header>
    <img src="/img/logo.png" alt="Logo" class="logo">
    <h1 class="title">RenovaMarket</h1>
</header>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid mx-5">
        <a class="navbar-brand" href="{{ route('home') }}"><i class="bi bi-house-door-fill"></i> {{__("Inicio")}}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">{{__("Tienda Online")}}</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{__("Compra-Venta")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{__("Subir producto")}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">{{__("Contacto")}}</a>
                    </li>

                @endauth

            </ul>
            <ul class="navbar-nav">
                @auth
                    <a class="nav-link" href="#">
                        <i class="bi bi-cart4"></i>
                    </a>
                    <!--<div class="dropdown show">
                        <a class="btn dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-globe2"></i> Idiomas
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                          <a class="dropdown-item" href="#">Perfil</a>
                          <a class="dropdown-item" href="#">Editar perfil</a>
                          <a class="dropdown-item" href="#">Subir producto</a>
                          <a class="dropdown-item"href="#"> Cerrar sesión</a>
                        </div>
                      </div>-->
                      <div>
                        Prueba:
                        <form action="{{ route('change-language') }}" method="POST">
                            @csrf
                            <select name="locale" onchange="this.form.submit()">
                                <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>English</option>
                                <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>Español</option>
                            </select>
                        </form>
                    </div>
                    <div>
                        {{ __('messages.welcome') }}
                    </div>

                    <div class="dropdown show">
                        <a class="btn dropdown-toggle nav-link" href="{{ route('home', Auth::user()) }}" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person-lines-fill"></i>{{ ucfirst(Auth::user()->name) }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#">{{__("Perfil")}}</a>
                            <a class="dropdown-item" href="#">{{__("Editar perfil")}}</a>
                            <a class="dropdown-item" href="#">{{__("Subir producto")}}</a>
                            <a class="dropdown-item"href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i>
                                {{__("Cerrar sesión")}}</a>
                        </div>
                    </div>
                @else
                    <li class="nav-item">
                        <a href="{{ route('loginForm') }}" class="nav-link">{{__("Iniciar sesión")}}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('signupForm') }}" class="nav-link">{{__("Registrarse")}}</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
