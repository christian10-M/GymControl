<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMachineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'        => 'required|string|max:150',
            'description' => 'nullable|string',
            'status'      => 'required|in:available,maintenance,out_of_service',
            'muscle_id'   => 'required|exists:muscles,id',
        ];
    }
}