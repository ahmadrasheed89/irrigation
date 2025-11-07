<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNocCategoryRequest extends FormRequest
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
            'noc_id' => 'required|exists:nocs,id',
            'noc_category_id' => 'required|exists:noc_categories,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'attached_files.*' => 'file|mimes:pdf,doc,docx,png,jpg,jpeg',
        ];
    }
}
