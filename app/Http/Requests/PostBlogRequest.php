<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostBlogRequest extends FormRequest
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
            'tipo_post_id' => 'required|integer|exists:tipo_posts,id',
            'titulo' => 'required|string|min:5|max:180',
            'noticia' => 'required|string|min:20',
            'imagen' => 'nullable|string|max:255',
        ];
    }
}
