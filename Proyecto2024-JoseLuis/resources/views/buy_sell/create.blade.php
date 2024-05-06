@extends('layout')

@section('title', __('Añadir producto'))

@section('content')

    <div class="container mt-5 mb-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body form-container">
                        <h1 class="card-title text-center mb-4">Subir producto</h1>
                        <form action="{{ route('userProducts.store') }}" method="POST" enctype="multipart/form-data"
                            class="needs-validation">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">Nombre</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    value="{{ old('name') }}">
                                <!--ERRORES NOMBRE-->
                                @error('name')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="description" class="form-label">Descripción</label>
                                <textarea class="form-control" id="description" name="description">{{ old('description') }}</textarea>
                                <!--ERRORES DESCRIPCION-->
                                @error('description')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="price" class="form-label">Precio</label>
                                <input type="number" class="form-control" id="price" name="price"
                                    value="{{ old('price', 0) }}" min="0">
                                <!--ERRORES PRECIO-->
                                @error('price')
                                    <div class="alert alert-danger mt-1 mb-1 small">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="category" class="form-label">Categoría</label>
                                <select class="form-control" id="category" name="category">
                                    <option value="Electrodomésticos"
                                        {{ old('category') === 'Electrodomésticos' ? 'selected' : '' }}>Electrodomésticos
                                    </option>
                                    <option value="Moda y accesorios"
                                        {{ old('category') === 'Moda y accesorios' ? 'selected' : '' }}>Moda y accesorios
                                    </option>
                                    <option value="Móviles" {{ old('category') === 'Móviles' ? 'selected' : '' }}>Móviles
                                    </option>
                                    <option value="Muebles" {{ old('category') === 'Muebles' ? 'selected' : '' }}>Muebles
                                    </option>
                                    <option value="Informática" {{ old('category') === 'Informática' ? 'selected' : '' }}>
                                        Informática</option>
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
                            <button type="submit" class="btn btn-primary">Añadir producto</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
