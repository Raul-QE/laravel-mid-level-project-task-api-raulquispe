<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest {
    public function authorize() {
        return true;
    }

    public function rules() {
        return [
            'project_id' => 'sometimes|required|exists:projects,id',
            'title' => 'sometimes|required|string|min:3|max:100',
            'description' => 'nullable|string',
            'status' => 'sometimes|required|in:pending,in_progress,done',
            'priority' => 'sometimes|required|in:low, medium,high',
            'due_date' => 'sometimes|required|date',
        ];
    }

    public function messages()
    {
        return [
            'project_id.required' => 'El ID del proyecto es obligatorio',
            'project_id.exists' => 'El proyecto asociado no existe',
            'title.required' => 'El titulo de la tarea es obligatorio',
            'title.min' => 'El titulo debe tener al menos 3 caracteres',
            'title.max' => 'El titulo no debe superar los 100 caracteres',
            'status.required' => 'El estado es obligatorio',
            'status.in' => 'El estado debe ser "pending", "in_progress" o "done" ',
            'priority.required' => 'La prioridad es obligatoria',
            'priority.in' => 'La prioridad debe ser "low", "medium" o "high" ',
            'due_date.required' => 'La fecha de vencimiento es obligatoria',
            'due_date.date' => 'La fecha de vencimiento debe ser valida',
        ];
    }
}