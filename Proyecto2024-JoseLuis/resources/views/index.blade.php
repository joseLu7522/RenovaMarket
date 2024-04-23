@extends('layout')

@section('title', __('Inicio'))

@section('content')
    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel" data-interval="5000">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="dark-overlay d-flex align-items-start justify-content-center">
                    <div class="carousel-caption text-light">
                        <h5 class="mb-4">{{ __('¡Bienvenido a RenovaMarket!') }}</h5>
                        <p>{{ __('¡Dale una nueva vida a los objetos que ya no utilizas! En RenovaMarket, creemos en el valor de la reutilización y te ofrecemos una plataforma segura y fácil de usar para') }}
                            {{ __('vender tus productos de segunda mano. Al mismo tiempo, puedes descubrir tesoros escondidos que otros han puesto a la venta. ¡Únete a nosotros y forma parte de la economía circular!') }}
                        </p>
                    </div>
                </div>
                <img src="{{ asset('img/Carousel/carousel1.jpg') }}" class="d-block w-100 carousel-image" alt="Carousel1">
            </div>
            <div class="carousel-item">
                <div class="dark-overlay d-flex align-items-start justify-content-center">
                    <div class="carousel-caption text-light">
                        <h5 class="mb-4">{{ __('¡Descubre nuestra variedad de productos de segunda mano y nuevos!') }}
                        </h5>
                        <p>{{ __('En RenovaMarket, no solo encontrarás una amplia gama de productos de segunda mano, sino también una selección de productos nuevos de alta calidad.') }}
                            {{ __('Ya sea que estés buscando un libro raro, un mueble vintage o un gadget tecnológico nuevo, seguro que lo encontrarás en nuestra plataforma. ¡Explora y descubre tus próximas adquisiciones!') }}
                        </p>
                    </div>
                </div>
                <img src="{{ asset('img/Carousel/carousel2.jpg') }}" class="d-block w-100 carousel-image" alt="Carousel2">
            </div>
            <div class="carousel-item">
                <div class="dark-overlay d-flex align-items-start justify-content-center">
                    <div class="carousel-caption text-light">
                        <h5 class="mb-4">{{ __('¡Únete a nuestra comunidad y encuentra lo que necesitas!') }}</h5>
                        <p>{{ __('RenovaMarket es más que una plataforma de compra y venta, es una comunidad de personas que valoran la reutilización y el intercambio. Al unirte a nosotros, no solo tendrás la oportunidad') }}
                            {{ __('de comprar y vender, sino también de conectar con otros usuarios, compartir tus intereses y contribuir a un consumo más sostenible. ¡Únete a RenovaMarket y encuentra exactamente lo que necesitas!') }}
                        </p>
                    </div>
                </div>
                <img src="{{ asset('img/Carousel/carousel3.jpg') }}" class="d-block w-100 carousel-image" alt="Carousel3">
            </div>
        </div>
    </div>

@endsection
