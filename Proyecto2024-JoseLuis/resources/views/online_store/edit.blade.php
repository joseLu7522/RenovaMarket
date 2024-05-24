<!--VISTA FORMULARIO EDITAR PRODUCTO DE LA TIENDA-->
@extends('layout')
@section('title', __('Editar producto'))
@section('content')

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card background-container">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">{{ __('Editar Producto') }}</h1>
                        <form action="{{ route('storeProducts.update', $storeProduct->id) }}" method="POST"
                            class="needs-validation" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">{{ __('Nombre') }}</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $storeProduct->name }}">
                                <!--ERRORES NOMBRE-->
                                @error('name')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ __($message) }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">{{ __('Precio') }}</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                    value="{{ $storeProduct->price }}">
                                <!--ERRORES PRECIO-->
                                @error('price')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ __($message) }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">{{ __('Descripción') }}</label>
                                <textarea class="form-control" id="description" name="description">{{ $storeProduct->description }}</textarea>
                                <!--ERRORES DESCRIPCIÓN-->
                                @error('description')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ __($message) }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="stock" class="form-label">{{ __('Cantidad') }}</label>
                                <input type="number" class="form-control" id="stock" name="stock"
                                    value="{{ $storeProduct->stock }}">
                                <!--ERRORES STOCK-->
                                @error('stock')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ __($message) }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">{{ __('Categoría') }}</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="Electrodomésticos"
                                        {{ $storeProduct->category == 'Electrodomésticos' ? 'selected' : '' }}>
                                        {{ __('Electrodomésticos') }}</option>
                                    <option value="Moda y accesorios"
                                        {{ $storeProduct->category == 'Moda y accesorios' ? 'selected' : '' }}>
                                        {{ __('Moda y accesorios') }}</option>
                                    <option value="Móviles" {{ $storeProduct->category == 'Móviles' ? 'selected' : '' }}>
                                        {{ __('Móviles') }}</option>
                                    <option value="Muebles" {{ $storeProduct->category == 'Muebles' ? 'selected' : '' }}>
                                        {{ __('Muebles') }}</option>
                                    <option
                                        value="Informática"{{ $storeProduct->category == 'Informática' ? 'selected' : '' }}>
                                        {{ __('Informática') }}</option>
                                </select>
                                <!--ERRORES CATEGORÍA-->
                                @error('category')
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
                            <button type="submit" class="btn btn-primary">{{ __('Editar Producto') }}</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        /*PREVISUALIZA LA IMAGEN AL INGRESARLA EN EL CAMPO DE EXAMINAR IMAGEN*/
        image.onchange = evt => {
            const [file] = image.files
            if (file) {
                previewimg.src = URL.createObjectURL(file)
            }
        }
    </script>
@endsection
