<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNocRequest extends FormRequest
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
            'issue_no' => 'required|string|max:255|unique:nocs,issue_no',
            'department' => 'required|',
            'noc_subject' => 'required',
            'nature_of_noc' => 'required',
            'remarks' => 'nullable',
            'issued_date' => 'required|date',
            'attached_files' => 'nullable|max:2048',
        ];
    }
}
