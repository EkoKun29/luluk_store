<?php

namespace App\Http\Requests;

use App\Models\Purchase;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDebtPaymentRequest extends FormRequest
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
            'purchase_id' => ['required', 'string', Rule::exists(Purchase::class, 'id')],
            'amount_paid' => ['required', 'integer'],
            'method' => ['required', 'integer', 'in:1,2'],
            'bank_name' => ['required_if:method,2', 'string', 'max:200'],
            'account_number' => ['required_if:method,2', 'string', 'max:200'],
            'account_name' => ['required_if:method,2', 'string', 'max:200']
        ];
    }

    public function attributes(): array
    {
        return [
            'date' => 'Tanggal',
            'purchase_id' => 'Pembelian',
            'amount_paid' => 'Jumlah Dibayarkan',
            'method' => 'Metode Pembayaran',
            'bank_name' => 'Nama Bank',
            'account_number' => 'Nomor Rekening',
            'account_name' => 'Atas Nama Akun'
        ];
    }
}
