<?php

namespace App\Http\Requests\Api\Internos;

use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class StoreClinicalHistoryRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'tipo_sangre' => ['required', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
            'peso' => ['nullable', 'numeric', 'between:30,300'],
            'estatura' => ['nullable', 'numeric', 'between:0.50,2.50'],
            'alergias' => ['nullable', 'string'],
            'padecimientos' => ['nullable', 'string'],
            'antecedentes_medicos' => ['nullable', 'string'],
            'enfermedades_cronicas' => ['nullable', 'string'],
            'cirugias_previas' => ['nullable', 'string'],
            'observaciones' => ['nullable', 'string'],
        ];
    }
}
