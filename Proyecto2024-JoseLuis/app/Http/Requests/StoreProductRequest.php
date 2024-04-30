<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Cambia a true si hay alguna lógica de autorización que necesitas aplicar
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:50|regex:/^[^\d]\w*/',
            'description' => 'required|string|regex:/^[^\d]\w*/',
            'price' => 'required|numeric|min:0|max:9999.99',
            'stock' => 'required|integer|min:0',
            'category' => 'required|string|in:Electrodomésticos,Moda y accesorios,Móviles,Muebles,Informática',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    /**
     * Get the validation error messages.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.string' => 'El nombre del producto debe ser un texto.',
            'name.max' => 'El nombre del producto no puede tener más de :max caracteres.',
            'name.regex' => 'El nombre del producto no puede comenzar con un número.',
            'description.required' => 'La descripción del producto es obligatoria.',
            'description.string' => 'La descripción del producto debe ser un texto.',
            'description.regex' => 'La descripción del producto no puede comenzar con un número.',
            'price.required' => 'El precio del producto es obligatorio.',
            'price.numeric' => 'El precio del producto debe ser numérico.',
            'price.min' => 'El precio del producto no puede ser negativo.',
            'price.max' => 'El precio del producto no puede ser mayor a :max.',
            'stock.required' => 'El stock del producto es obligatorio.',
            'stock.integer' => 'El stock del producto debe ser un número entero.',
            'stock.min' => 'El stock del producto no puede ser negativo.',
            'category.required' => 'La categoría del producto es obligatoria.',
            'category.string' => 'La categoría del producto debe ser un texto.',
            'category.in' => 'La categoría seleccionada no es válida.',
            'image.required' => 'La imagen del producto es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'El archivo debe ser una imagen de tipo: jpeg, png, jpg o gif.',
            'image.max' => 'El tamaño máximo permitido para la imagen es de :max kilobytes.',
        ];
    }
}
