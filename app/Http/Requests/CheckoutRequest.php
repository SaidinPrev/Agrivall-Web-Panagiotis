<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
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
            'nombre_cliente' => 'required|string|min:5',
            'email_cliente' => 'required|email',
            'tlf_cliente' => 'required|string|min:8',
            'direccion_envio' => 'required|string',
            'metodo_pago' => 'required|in:bizum,transferencia'
        ];
    }
}
