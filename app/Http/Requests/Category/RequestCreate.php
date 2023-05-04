<?php

namespace App\Http\Requests\Category;

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
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:categories,slug',
            'description' => 'string|max:255',
            'icon' => 'string|max:255',
            'parent_id' => 'integer|exists:categories,id'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     */
    public function messages(): array
    {
        return [
            'name.required' => 'Kategori adı zorunludur.',
            'name.max' => 'Kategori adı en fazla 255 karakter olmalıdır.',
            'slug.required' => 'Kategori slug\'ı zorunludur.',
            'slug.max' => 'Kategori slug\'ı en fazla 255 karakter olmalıdır.',
            'slug.unique' => 'Kategori slug\'ı benzersiz olmalıdır.',
            'description.max' => 'Kategori açıklaması en fazla 255 karakter olmalıdır.',
            'icon.max' => 'Kategori ikonu en fazla 255 karakter olmalıdır.',
            'parent_id.exists' => 'Seçili üst kategori veritabanında bulunmamaktadır.'
        ];
    }
}
