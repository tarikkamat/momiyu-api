<?php

namespace App\Http\Requests\Category;

use Illuminate\Foundation\Http\FormRequest;

class RequestUpdate extends FormRequest
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
            'name' => 'string|max:255',
            'slug' => 'string|max:255|unique:categories,slug,' . $this->id,
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
            'name.max' => 'Kategori adı en fazla 255 karakter olmalıdır.',
            'slug.max' => 'Kategori slug\'ı en fazla 255 karakter olmalıdır.',
            'slug.unique' => 'Kategori slug\'ı benzersiz olmalıdır.',
            'description.max' => 'Kategori açıklaması en fazla 255 karakter olmalıdır.',
            'icon.max' => 'Kategori ikonu en fazla 255 karakter olmalıdır.',
            'parent_id.exists' => 'Kategori üst kategorisi veritabanında bulunmalıdır.'
        ];
    }
}
