@extends('layout')

@section('title', __('Editar producto'))

@section('content')

    <div class="container mt-4 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card background-container">
                    <div class="card-body">
                        <h1 class="card-title text-center mb-4">Editar Producto</h1>
                        <form action="{{ route('userProducts.update', $userProduct->id) }}" method="POST"
                            class="needs-validation" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ $userProduct->name }}">
                                <!--ERRORES NOMBRE-->
                                @error('name')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Precio</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price"
                                    value="{{ $userProduct->price }}">
                                <!--ERRORES PRECIO-->
                                @error('price')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea class="form-control" id="description" name="description">{{ $userProduct->description }}</textarea>
                                <!--ERRORES DESCRIPCIÓN-->
                                @error('description')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Categoría</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="Electrodomésticos"
                                        {{ $userProduct->category == 'Electrodomésticos' ? 'selected' : '' }}>
                                        Electrodomésticos</option>
                                    <option value="Moda y accesorios"
                                        {{ $userProduct->category == 'Moda y accesorios' ? 'selected' : '' }}>Moda y
                                        accesorios</option>
                                    <option value="Móviles" {{ $userProduct->category == 'Móviles' ? 'selected' : '' }}>
                                        Móviles</option>
                                    <option value="Muebles" {{ $userProduct->category == 'Muebles' ? 'selected' : '' }}>
                                        Muebles</option>
                                    <option value="Informática"
                                        {{ $userProduct->category == 'Informática' ? 'selected' : '' }}>Informática
                                    </option>
                                </select>
                                <!--ERRORES CATEGORÍA-->
                                @error('category')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image" class="form-label">Imagen</label>
                                <input type="file" class="form-control" id="image" name="image">
                                <!--ERRORES IMAGEN-->
                                @error('image')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Editar Producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection