<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePurchaseRequest extends FormRequest
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
            'date' => ['required', 'date'],
            'supplier' => ['required', 'string', 'max:200'],
            'store_name' => ['required', 'string', 'max:200'],
            'amount_paid' => ['required', 'integer'],
            'method' => ['required', 'integer', 'in:0,1,2'],
            'purchase_details.*.product_id' => ['required', 'string', Rule::exists(Product::class, 'id')],
            'purchase_details.*.amount' => ['required', 'numeric', 'gt:0'],
            'purchase_details.*.price' => ['required', 'integer'],
            'bank_id' => ['required_if:method,2', 'nullable', 'string', 'max:200'],
            'no_rekening_id' => ['required_if:method,2', 'nullable', 'string', 'max:200'],
            'account_name' => ['required_if:method,2', 'nullable', 'string', 'max:200']
        ];
    }

    public function attributes(): array
    {
        return [
            'date' => 'Tanggal',
            'supplier' => 'Supplier',
            'store_name' => 'Nama Toko',
            'amount_paid' => 'Jumlah Dibayarkan',
            'method' => 'Metode',
            'purchaseDetails.*.product_id' => 'Produk',
            'purchaseDetails.*.amount' => 'Jumlah Produk',
            'purchaseDetails.*.price' => 'Harga Produk',
            'bank_id' => 'Bank',
            'no_rekening_id' => 'Nomor Rekening',
            'account_name' => 'Atas Nama Akun'
        ];
    }
}
