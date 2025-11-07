<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateNocRequest extends FormRequest
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
        $id = $this->route('adp');
        return [
            'department' => 'required|',
            'noc_subject' => 'required',
            'nature_of_noc' => 'required',
            'remarks' => 'nullable',
            'issued_date' => 'required|date',
            'attached_files' => 'nullable|max:2048',
        ];
    }
}
