<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMuscleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // <- aquí, no abajo
    }

    public function rules(): array
    {
        return [
            'name'      => 'required|string|max:100',
            'body_part' => 'nullable|string|max:100',
        ];
    }
}