<?php

namespace App\Http\Requests\Api\Medicamentos;

use App\Exceptions\ApiException;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;

class UpdatePrescriptionRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'dosis' => ['sometimes', 'string', 'max:30'],
            'frecuencia' => ['sometimes', 'string', 'max:30'],
        ];
    }

    protected function afterValidation(Validator $validator): void
    {
        if ($this->filled('dosis') && ! preg_match('/\S/', (string) $this->input('dosis'))) {
            throw new ApiException('MED-1003', 'El formato de la dosis no es válido', 422);
        }
    }
}
