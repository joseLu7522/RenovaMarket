<header>
    <img src="/img/logo.png" alt="Logo" class="logo">
    <h1 class="title">RenovaMarket</h1>
</header>

<nav class="navbar sticky-top navbar-expand-lg navbar-dark navbar-custom">
    <div class="container-fluid mx-5">
        <a class="navbar-brand" href="{{ route('home') }}"><i class="bi bi-house-door-fill"></i> {{ __('Inicio') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('storeProducts.index') }}">{{ __('Tienda online') }}</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('userProducts.index') }}">{{ __('Compra-venta') }}</a>
                    </li>
                    @if (Auth::user()->rol == 'admin')
                        <li class="nav-item">
                            <a class="nav-link"
                                href="{{ route('storeProducts.create') }}">{{ __('Añadir producto a tienda') }}</a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('userProducts.create') }}">{{ __('Subir producto') }}</a>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('messages.index') }}">{{ __('Mensajes') }}</a>
                    </li>

                @endauth

            </ul>
            <ul class="navbar-nav">
                @auth
                    @if (request()->routeIs('storeProducts.index'))
                        <a class="nav-link" href="{{ route('cart.index') }}">
                            <i class="bi bi-cart4"></i>
                            {{ \Cart::session(Auth::user())->getTotalQuantity() }}
                        </a>
                    @endif
                @endauth

                <div class="dropdown show">
                    <a class="btn dropdown-toggle nav-link" href="#" role="button" id="dropdownMenuLink"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="bi bi-globe2"></i>
                        {{ app()->getLocale() == 'en' ? 'English' : (app()->getLocale() == 'es' ? 'Español' : 'Valencià') }}
                    </a>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <form action="{{ route('change-language') }}" method="POST">
                            @csrf
                            @if (app()->getLocale() == 'es')
                                <button class="dropdown-item" name="locale" value="es" selected disabled>🇪🇸
                                    Español</button>
                                <button class="dropdown-item" name="locale" value="en">🇬🇧 English</button>
                                <button class="dropdown-item" name="locale" value="ca"><img src="/img/flag.png"
                                        alt="flag-ca" class="flag"> Valencià</button>
                            @elseif(app()->getLocale() == 'ca')
                                <button class="dropdown-item" name="locale" value="ca" selected disabled><img
                                        src="/img/flag.png" alt="flag-ca" class="flag selected"> Valencià</button>
                                <button class="dropdown-item" name="locale" value="en">🇬🇧 English</button>
                                <button class="dropdown-item" name="locale" value="es">🇪🇸 Español</button>
                            @else
                                <button class="dropdown-item" name="locale" value="en" selected disabled>🇬🇧
                                    English</button>
                                <button class="dropdown-item" name="locale" value="es">🇪🇸 Español</button>
                                <button class="dropdown-item" name="locale" value="ca"><img src="/img/flag.png"
                                        alt="flag-ca" class="flag"> Valencià</button>
                            @endif
                        </form>
                    </div>
                </div>
                @auth
                    <div class="dropdown show">
                        <a class="btn dropdown-toggle nav-link" href="{{ route('home', Auth::user()) }}" role="button"
                            id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="bi bi-person-lines-fill"></i> {{ ucfirst(Auth::user()->name) }}
                        </a>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item"
                                href="{{ route('users.show', Auth::user()) }}">{{ __('Perfil') }}</a>
                            <a class="dropdown-item" href="{{ route('users.edit', Auth::user()->id) }}">{{ __('Editar perfil') }}</a>
                            @if (Auth::user()->rol == 'admin')
                                <a class="dropdown-item"
                                    href="{{ route('storeProducts.create') }}">{{ __('Subir producto') }}</a>
                            @else
                                <a class="dropdown-item"
                                    href="{{ route('userProducts.create') }}">{{ __('Subir producto') }}</a>
                            @endif
                            <a class="dropdown-item"href="{{ route('logout') }}"><i class="bi bi-box-arrow-right"></i>
                                {{ __('Cerrar sesión') }}</a>
                        </div>
                    </div>
                @else
                    <li class="nav-item">
                        <a href="{{ route('loginForm') }}" class="nav-link">{{ __('Iniciar sesión') }}</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('signupForm') }}" class="nav-link">{{ __('Registrarse') }}</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
