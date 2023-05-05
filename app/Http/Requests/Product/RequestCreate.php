<?php

namespace App\Http\Requests\Product;

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
            'slug' => 'required|string|max:255|unique:products,slug',
            'description' => 'string',
            'sku' => 'required|string|max:255|unique:products,sku',
            'price' => 'required|numeric',
            'quantity' => 'required|integer',
            'status' => 'required|in:draft,active,inactive',
            'synced_at' => 'integer',
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
            'name.required' => 'Ürün adı alanı zorunludur.',
            'name.string' => 'Ürün adı alanı metin tipinde olmalıdır.',
            'name.max' => 'Ürün adı alanı en fazla 255 karakter olmalıdır.',
            'slug.required' => 'Ürün slug alanı zorunludur.',
            'slug.string' => 'Ürün slug alanı metin tipinde olmalıdır.',
            'slug.max' => 'Ürün slug alanı en fazla 255 karakter olmalıdır.',
            'slug.unique' => 'Ürün slug alanı benzersiz olmalıdır.',
            'description.string' => 'Ürün açıklama alanı metin tipinde olmalıdır.',
            'sku.required' => 'Ürün SKU alanı zorunludur.',
            'sku.string' => 'Ürün SKU alanı metin tipinde olmalıdır.',
            'sku.max' => 'Ürün SKU alanı en fazla 255 karakter olmalıdır.',
            'sku.unique' => 'Ürün SKU alanı benzersiz olmalıdır.',
            'price.required' => 'Ürün fiyatı alanı zorunludur.',
            'price.numeric' => 'Ürün fiyatı alanı sayı tipinde olmalıdır.',
            'quantity.required' => 'Ürün miktarı alanı zorunludur.',
            'quantity.integer' => 'Ürün miktarı alanı tam sayı tipinde olmalıdır.',
            'status.required' => 'Ürün durumu alanı zorunludur.',
            'status.in' => 'Ürün durumu alanı taslak, aktif, pasif değerlerinden biri olmalıdır.',
            'synced_at.integer' => 'Ürün senkronizasyon tarihi alanı tam sayı tipinde olmalıdır.',
        ];
    }
}
