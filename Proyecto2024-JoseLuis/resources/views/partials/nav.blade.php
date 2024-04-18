<header>
    <img src="/img/logo.png" alt="Logo" class="logo">
    <h1 class="title">RenovaMarket</h1>
</header>

<nav class="navbar navbar-expand-lg navbar-dark navbar-custom ">
    <div class="container">
        <a class="navbar-brand" href="{{ route('home') }}"><i class="bi bi-house-door-fill"></i> Inicio</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">Tienda Online</a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Compra-Venta</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Subir producto</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('home') }}">Contacto</a>
                    </li>

                @endauth

            </ul>
            <ul class="navbar-nav">
                @auth
                @else
                    <li class="nav-item">
                        <a href="{{ route('loginForm') }}" class="nav-link">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('signupForm') }}" class="nav-link">Registrarse</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
