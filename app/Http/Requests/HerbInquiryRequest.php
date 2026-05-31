<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HerbInquiryRequest extends FormRequest
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
            'nombre' => 'required|string|min:5',
            'email' => 'required|email',
            'telefono' => 'nullable|string',
            'mensaje' => 'required|string|min:15'
        ];
    }
}
