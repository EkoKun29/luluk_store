<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCashDepositRequest extends FormRequest
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
            'recipient' => ['required', 'string', 'max:200'],
            'amount' => ['required', 'integer']
        ];
    }

    public function attributes(): array
    {
        return [
            'date' => 'Tanggal',
            'recipient' => 'Penerima',
            'amount' => 'Jumlah'
        ];
    }
}
