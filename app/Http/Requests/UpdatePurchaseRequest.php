<?php

namespace App\Http\Requests;

use App\Models\Product;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePurchaseRequest extends FormRequest
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
            'note_number' => ['required', 'string', 'max:200'],
            'date' => ['required', 'date'],
            'supplier' => ['required', 'string', 'max:200'],
            'store_name' => ['required', 'string', 'max:200'],
            'method' => ['required', 'integer', 'in:0,1,2'],
            'amount_paid' => ['required', 'integer'],
            'purchaseDetails.*.product_id' => ['required', 'string', Rule::exists(Product::class, 'id')],
            'purchaseDetails.*.amount' => ['required', 'numeric', 'gt:0'],
            'purchaseDetails.*.price' => ['required', 'integer'],
            'bank_name' => ['required_if:method,2', 'string', 'max:200'],
            'account_number' => ['required_if:method,2', 'string', 'max:200'],
            'account_name' => ['required_if:method,2', 'string', 'max:200']
        ];
    }

    public function attributes(): array
    {
        return [
            'note_number' => 'Nomor Nota',
            'date' => 'Tanggal',
            'supplier' => 'Supplier',
            'store_name' => 'Nama Toko',
            'method' => 'Metode',
            'amount_paid' => 'Jumlah Dibayarkan',
            'purchaseDetails.*.product_id' => 'Produk',
            'purchaseDetails.*.amount' => 'Jumlah Produk',
            'purchaseDetails.*.price' => 'Harga Produk',
            'bank_name' => 'Nama Bank',
            'account_number' => 'Nomor Rekening',
            'account_name' => 'Atas Nama Akun'
        ];
    }
}
