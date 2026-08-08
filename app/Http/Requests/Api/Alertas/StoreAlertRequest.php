<?php

namespace App\Http\Requests\Api\Alertas;

use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreAlertRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'tipo_alerta' => ['required', 'string', 'max:30'],
            'descripcion' => ['required', 'string'],
            'origen' => ['required', 'string', 'max:50'],
        ];
    }

    protected function refForFailedValidation(Validator $validator): array
    {
        return ['ALT-1002', 400, 'Completa el tipo de alerta y descripción'];
    }
}
