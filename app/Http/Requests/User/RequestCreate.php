<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class RequestCreate extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|max:30',
            'role' => 'string|exists:roles,name'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Ad alanı boş bırakılamaz.',
            'name.max' => 'Ad alanı en fazla 30 karakter olmalıdır.',
            'email.required' => 'E-posta alanı boş bırakılamaz.',
            'email.email' => 'E-posta alanı e-posta formatında olmalıdır.',
            'email.unique' => 'E-posta alanı daha önce kullanılmış.',
            'password.required' => 'Şifre alanı boş bırakılamaz.',
            'password.min' => 'Şifre alanı en az 6 karakter olmalıdır.',
            'password.max' => 'Şifre alanı en fazla 30 karakter olmalıdır.',
            'role.required' => 'Rol alanı boş bırakılamaz.',
            'role.exists' => 'Rol alanı sistemde kayıtlı değil.'
        ];
    }
}
