<?php

namespace App\Http\Requests;

use App\Models\ProductPrice;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSaleRequest extends FormRequest
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
            'consumer' => ['required', 'string', 'max:200'],
            'store_name' => ['required', 'string', 'max:200'],
            'method' => ['required', 'integer', 'in:1,2,3'],
            'saleDetails.*.product_price_id' => ['required', 'string', Rule::exists(ProductPrice::class, 'id')],
            'saleDetails.*.no_lot' => ['required', 'string'],
            'saleDetails.*.amount' => ['required', 'numeric', 'gt:0'],
            'sales' => ['required_unless:method,1', 'string', 'max:200'],
            'brought_by' => ['required_unless:method,1', 'string', 'max:200'],
            'bank_name' => ['required_if:method,3', 'string', 'max:200'],
            'account_number' => ['required_if:method,3', 'string', 'max:200'],
            'account_name' => ['required_if:method,3', 'string', 'max:200']
        ];
    }

    public function attributes(): array
    {
        return [
            'note_number' => 'No. Nota',
            'date' => 'Tanggal',
            'consumer' => 'Konsumen',
            'store_name' => 'Nama Toko',
            'method' => 'Metode',
            'saleDetails.*.product_price_id' => 'Produk',
            'saleDetails.*.no_lot' => 'No. Lot',
            'saleDetails.*.amount' => 'Jumlah',
            'sales' => 'Sales',
            'brought_by' => 'Dibawa Oleh',
            'bank_name' => 'Nama Bank',
            'account_number' => 'Nomor Rekening',
            'account_name' => 'Atas Nama Akun'
        ];
    }
}
