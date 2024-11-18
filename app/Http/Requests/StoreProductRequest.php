<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:200', Rule::unique(Product::class, 'name')],
            'stock' => ['required', 'numeric'],
            'unit' => ['required', 'string', 'max:100']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama'
        ];
    }
}
