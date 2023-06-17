<?php

namespace App\Http\Requests\Employee;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation attributes that apply to the request.
     */
    public function attributes(): array
    {
        return [
            'first_name' => 'Nombre(s)',
            'last_name'  => 'Apellidos',
            'start_date' => 'Fecha de inicio',
            'position_id'=> 'Posición',
            'company_id' => 'Compañía',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:3|max:32',
            'last_name'  => 'required|string|min:3|max:32',
            'start_date' => 'required|date|date_format:Y-m-d',
            'position_id'=> 'required|integer|exists:positions,id',
            'company_id' => 'required|integer|exists:companies,id',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'first_name.required' => 'El :attribute es requerido.',
            'first_name.string'   => 'El :attribute debe ser una cadena de caracteres.',
            'first_name.min'      => 'El :attribute debe tener al menos :min caracteres.',
            'first_name.max'      => 'El :attribute debe tener máximo :max caracteres.',

            'last_name.required'  => 'El :attribute es requerido.',
            'last_name.string'    => 'El :attribute debe ser una cadena de caracteres.',
            'last_name.min'       => 'El :attribute debe tener al menos :min caracteres.',
            'last_name.max'       => 'El :attribute debe tener máximo :max caracteres.',

            'start_date.required' => 'La :attribute es requerida.',
            'start_date.date'     => 'La :attribute debe ser una fecha válida.',
            'start_date.date_format' => 'La :attribute debe tener el formato YYYY-MM-DD.',

            'position_id.required'=> 'La :attribute es requerida.',
            'position_id.integer' => 'La :attribute debe ser un número entero.',
            'position_id.exists'  => 'La :attribute no existe.',
            
            'company_id.required' => 'La :attribute es requerida.',
            'company_id.integer'  => 'La :attribute debe ser un número entero.',
            'company_id.exists'   => 'La :attribute no existe.',
        ];
    }
}
