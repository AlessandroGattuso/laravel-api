<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTechnologyRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [       
            'name' => ['required', Rule::unique('types')->ignore($this->technology) ,'max:70'],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
    */
    public function messages()
    {
        return [
            'name.required' => 'Il nome è obbligatorio',
            'name.unique' => 'Questo nome è già stato assegnato ad una tecnologia',
            'name.max' => 'Il name non deve essere più lungo di :max caratteri',
        ];
    }
}
