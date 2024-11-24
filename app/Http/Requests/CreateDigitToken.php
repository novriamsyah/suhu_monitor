<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDigitToken extends FormRequest
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
            'id_kwh' => 'required|numeric|digits_between:11,12',
            // 'digit_token' => 'required|string|size:19|unique:digit_tokens,digit_token',
            'tarif_token' => 'required|numeric',
        ];
    }

    public function messages(): array
    {
        return [
            'id_kwh.required' => 'KWh harus diisi',
            'id_kwh.numeric' => 'KWh harus berupa angka',
            'id_kwh.digits_between' => 'KWh harus 11 atau 12 digit',
            'tarif_token.required' => 'Tarif harus diisi',
            'tarif_token.numeric' => 'Tarif harus berupa angka',
            // 'digit_token.required' => 'Token harus diisi',
            // 'digit_token.string' => 'Token harus berupa string',
            // 'digit_token.unique' => 'Token sudah ada',
            // 'digit_token.size' => 'Token harus 16 karakter',
        ];
    }
}
