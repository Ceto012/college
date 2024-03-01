<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlacaRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'archivo' => 'required|file|mimes:csv,txt',
        ];
    }

    public function messages(): array
    {
        return [
            'archivo.required' => 'Solo se permiten archivos .csv o .txt',
            'archivo.mimes' => 'El  archivo debe ser un archivo CSV o TXT.'
        ];
    }
}
