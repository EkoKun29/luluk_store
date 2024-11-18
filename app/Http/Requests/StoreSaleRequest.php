<?php

namespace App\Http\Requests;

use App\Models\ProductPrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSaleRequest extends FormRequest
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
            'consumer' => ['required', 'string', 'max:200'],
            'store_name' => ['required', 'string', 'max:200'],
            'amount_paid' => ['required', 'integer'],
            'method' => ['required', 'integer', 'in:0,1,2'],
            'sale_details.*.product_price_id' => ['required', 'string', Rule::exists(ProductPrice::class, 'id')],
            'sale_details.*.amount' => ['required', 'numeric', 'gt:0'],
            'bank_id' => ['required_if:method,2', 'nullable', 'string', 'max:200'],
            'no_rekening_id' => ['required_if:method,2', 'nullable', 'string', 'max:200'],
            'account_name' => ['required_if:method,2', 'nullable', 'string', 'max:200']
        ];
    }

    public function attributes(): array
    {
        return [
            'date' => 'Tanggal',
            'consumer' => 'Konsumen',
            'store_name' => 'Nama Toko',
            'amount_paid' => 'Jumlah Dibayarkan',
            'method' => 'Metode',
            'saleDetails.*.product_price_id' => 'Produk',
            'saleDetails.*.amount' => 'Jumlah',
            'saleDetails.*.price' => 'Harga',
            'bank_id' => 'Bank',
            'no_rekening_id' => 'Nomor Rekening',
            'account_name' => 'Atas Nama Akun'
        ];
    }


}