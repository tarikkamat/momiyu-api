<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RequestLogin extends FormRequest
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
            'email' => 'required|email|max:255',
            'password' => 'required|max:255',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'email.required' => 'Bu kısım boş bırakılamaz!',
            'email.email' => 'E-posta geçerli değil!',
            'email.max' => 'E-posta uzunluğu çok fazla!',
            'password.required' => 'Bu kısım boş bırakılamaz!',
            'password.max' => 'Şifre uzunluğu çok fazla!',
        ];
    }
}

