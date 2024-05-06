<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|min:4|max:30|regex:/^[^\d]\w*/',
            'description' => 'required|max:200|string|regex:/^[^\d]\w*/',
            'price' => 'required|numeric|min:0|max:9999.99',
            'category' => 'required|string|in:Electrodomésticos,Moda y accesorios,Móviles,Muebles,Informática',
            'image' => 'required|image|mimes:png|max:2048',

        ];
    }
    public function messages()
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'name.string' => 'El nombre del producto debe ser texto.',
            'name.min' => 'El nombre del producto debe tener al menos 4 caracteres.',
            'name.max' => 'El nombre del producto no puede tener más de 30 caracteres.',
            'name.regex' => 'El nombre del producto no puede comenzar con un número.',
            'description.required' => 'La descripción del producto es obligatoria.',
            'description.max' => 'La descripción del producto no puede tener más de 200 caracteres.',
            'description.string' => 'La descripción del producto debe ser un texto.',
            'description.regex' => 'La descripción del producto no puede comenzar con un número.',
            'price.required' => 'El precio del producto es obligatorio.',
            'price.numeric' => 'El precio del producto debe ser un número.',
            'price.min' => 'El precio del producto no puede ser negativo.',
            'price.max' => 'El precio del producto no puede ser mayor a 9999.99€.',
            'category.required' => 'La categoría del producto es obligatoria.',
            'category.string' => 'La categoría del producto debe ser un texto.',
            'category.in' => 'La categoría seleccionada no es válida.',
            'image.required' => 'La imagen del producto es obligatoria.',
            'image.image' => 'El archivo debe ser una imagen.',
            'image.mimes' => 'El archivo debe ser una imagen de tipo PNG.',
            'image.max' => 'El tamaño máximo permitido para la imagen es de 2048 kilobytes.',
        ];
    }
}
