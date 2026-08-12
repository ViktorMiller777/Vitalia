<?php

namespace App\Http\Requests\Api\Medicamentos;

use App\Http\Requests\Api\ApiFormRequest;

class StoreAdministrationRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'dosis_administrada' => ['nullable', 'string'],
            'observaciones' => ['nullable', 'string'],
        ];
    }
}
