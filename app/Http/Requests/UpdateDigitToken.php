<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDigitToken extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kwh' => 'required|numeric|unique:digit_tokens,kwh',
            'digit_token' => 'required|string|size:19|unique:digit_tokens,digit_token',
        ];
    }

    public function messages(): array
    {
        return [
            'kwh.required' => 'KWh harus diisi',
            'kwh.numeric' => 'KWh harus berupa angka',
            'kwh.unique' => 'KWh sudah ada',
            'digit_token.required' => 'Token harus diisi',
            'digit_token.string' => 'Token harus berupa string',
            'digit_token.unique' => 'Token sudah ada',
            'digit_token.size' => 'Token harus 16 karakter',
        ];
    }
}
