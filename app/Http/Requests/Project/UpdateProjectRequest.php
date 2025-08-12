<?php

namespace App\Http\Requests\Project;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'name' => [
                'required',
                'string',
                'min:3',
                'max:100',
                Rule::unique('projects', 'name')->ignore($this->route('id')),
            ],
            'description' => 'nullable|string',
            'status' => 'required|in:active,inactive',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre del proyecto es obligatorio',
            'name.min' => 'El nombre debe tener al menos 3 caracteres',
            'name.max' => 'El nombre no debe superar los 100 caracteres',
            'name.unique' => 'Ya existe un proyecto con este nombre',
            'status.required' => 'El estado es obligatorio',
            'status.in' => 'El estado debe ser "active" o "inactive" ',
        ];
    }
}