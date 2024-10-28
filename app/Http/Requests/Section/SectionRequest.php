<?php

namespace App\Http\Requests\Section;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SectionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>['required', 'string','min:8','max:16'],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The department name is required.',
            'name.string' => 'The department name must be a string.',
            'name.min' => 'The department name must be at least 8 characters long.',
            'name.max' => 'The department name must not exceed 16 characters.',
            'name.unique' => 'This department name has already been taken.',
        ];
    }
}
