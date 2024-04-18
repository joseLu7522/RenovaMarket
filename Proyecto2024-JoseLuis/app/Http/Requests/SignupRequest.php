<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class SignupRequest extends FormRequest
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
        $today = Carbon::now()->format('Y-m-d');
        switch ($this->method()) {
            case 'POST':
                $rules['email'] = 'required|email|min:10|max:50|unique:users';
                break;
            case 'PUT':
                $rules['email'] = [
                    'required',
                    'email',
                    'min:10',
                    'max:50',
                    Rule::unique('users')->ignore($this->user->id)
                ];
                break;
        }
        $rules['name'] = 'required|string|min:4|max:50|regex:/^[a-zA-Z\s]+$/';
        $rules['password'] = 'required|string|min:8';
        $rules['birthday'] = [
            'required',
            'date',
            function ($attribute, $value, $fail) use ($today) {
                if (Carbon::parse($value)->greaterThanOrEqualTo($today)) {
                    $fail('La fecha debe ser anterior a hoy.');
                }
            },
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'name.required' => 'El campo nombre es obligatorio.',
            'name.string' => 'El campo nombre debe ser una cadena de texto.',
            'name.min' => 'El campo nombre debe tener al menos 4 caracteres.',
            'name.max' => 'El campo nombre no puede tener más de 50 caracteres.',
            'name.regex' => 'El campo nombre debe ser una cadena de texto.',
            'email.required' => 'El campo email es obligatorio.',
            'email.email' => 'El campo email debe ser una dirección de correo electrónico válida.',
            'email.min' => 'El campo email debe tener al menos 10 caracteres.',
            'email.max' => 'El campo email no puede tener más de 50 caracteres.',
            'email.unique' => 'Ya existe un usuario con este email.',
            'password.required' => 'El campo contraseña es obligatorio.',
            'password.string' => 'El campo contraseña debe ser una cadena de texto.',
            'password.min' => 'El campo contraseña debe tener al menos 8 caracteres.',
            'birthday.required' => 'El campo fecha de nacimiento es obligatorio.',
            'birthday.date' => 'El campo fecha de nacimiento debe ser una fecha válida.',
        ];
    }
}
