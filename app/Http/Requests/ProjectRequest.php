<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
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
            'name' => 'required|min:2|max:50',
            'description' => 'required|min:2|max:100',
            'date' => 'required|min:10|max:10'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Devi inserire il nome del progetto',
            'name.min' => 'Il nome del progetto deve contenere almeno :min caratteri',
            'name.max' => 'Il nome del progetto non deve contenere più di :max caratteri',
            'description.required' => 'Devi inserire la descrizione',
            'description.min' => 'La descrizione deve contenere almeno :min caratteri',
            'description.max' => 'La descrizione non deve contenere più di :max caratteri',
            'date.required' => 'Devi inserire la data',
            'date.min' => 'La data deve contenere almeno :min caratteri',
            'date.max' => 'La data non deve contenere più di :max caratteri'
        ];
    }
}
