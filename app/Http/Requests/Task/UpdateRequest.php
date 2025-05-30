<?php

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRequest extends FormRequest
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
            'project_id' => ['required', Rule::exists('projects', 'id')
                ->where(fn($q) => $q->where('status', 'active'))],
            'title' => [
                'required',
                'string',
                'min:3',
                'max:100'
            ],
            'description' => 'nullable|string|max:1000',
            'priority' => [
                'required',
                'string',
                Rule::in(['low', 'medium', 'high'])
            ],
            'status' => [
                'required',
                'string',
                Rule::in(['pending', 'in_progress', 'done'])
            ],
            'due_date' => 'nullable|date|after_or_equal:today',
        ];
    }
    public function messages(): array
    {
        return [
            'required' => 'El campo :attribute es requerido.',
            'string' => 'El campo :attribute tiene que ser un texto valido.',
            'min' => 'El campo :attribute debe tener al menos :min caracteres.',
            'max' => 'El campo :attribute debe tener como máximo :max caracteres.',
            'exists' => 'El valor del campo :attribute no es válido.',
            'in' => 'El valor del campo :attribute debe ser uno de los siguientes: :values.',
            'after_or_equal' => 'La fecha de vencimiento debe ser hoy o una fecha futura.',
        ];
    }

    public function attributes(): array
    {
        return [
            'project_id' => 'ID del proyecto',
            'title' => 'título de la tarea',
            'description' => 'descripción de la tarea',
            'priority' => 'prioridad de la tarea',
            'due_date' => 'fecha de vencimiento',
        ];
    }
}
