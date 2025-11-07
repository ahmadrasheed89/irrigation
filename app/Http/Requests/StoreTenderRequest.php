<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTenderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'scheme_id' => 'required|exists:schemes,id',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|string',
            'date' => 'required|date',
            'attached_files.*' => 'file|mimes:pdf,doc,docx,png,jpg,jpeg',
        ];
    }
}
