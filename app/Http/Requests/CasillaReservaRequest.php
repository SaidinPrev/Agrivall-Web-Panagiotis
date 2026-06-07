<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CasillaReservaRequest extends FormRequest
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
            'semana_casilla_id' => 'required|integer|exists:semana_casillas,id',
            'nombre' => 'required|string|min:3|max:120',
            'email' => 'required|email|max:160',
            'telefono' => 'nullable|string|max:40',
            'observaciones' => 'nullable|string|max:2000',
        ];
    }
}
