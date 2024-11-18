<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateAuditRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:100'],
            'date' => ['required', 'date'],
            'product_id' => ['required', 'string', Rule::exists(Product::class, 'id')],
            'amount' => ['required', 'integer'],
            'number_of_audit' => ['nullable', 'integer'],
            'status' => ['required', 'integer', 'in:1,2,3']
        ];
    }

    public function attributes(): array
    {
        return [
            'name' => 'Nama',
            'date' => 'Tanggal',
            'product_id' => 'Produk',
            'amount' => 'Jumlah Barang',
            'number_of_audit' => 'Jumlah Barang Terverifikasi',
        ];
    }
}
