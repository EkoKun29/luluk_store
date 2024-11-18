<?php

namespace App\Http\Requests;

use App\Models\Bank;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateNoRekeningRequest extends FormRequest
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
            'bank_id' => ['required', 'integer', Rule::exists(Bank::class, 'id')],
            'account_number' => ['required', 'numeric', 'digits_between:1,20'],
            'name' => ['required', 'string', 'max:200']
        ];
    }
}
