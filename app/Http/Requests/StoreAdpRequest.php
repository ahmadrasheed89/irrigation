<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdpRequest extends FormRequest
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
            'adp_code' => 'required|string|max:255|unique:adps,adp_code',
            'allocation' => 'required|numeric|min:0',
            'adp_t_s_cost' => 'required|numeric|min:0',
            'total_expenditure' => 'numeric|min:0',
            'accured_liability' => 'numeric|min:0',
            'attached_files' => 'nullable|file|max:2048',
        ];
    }
}
