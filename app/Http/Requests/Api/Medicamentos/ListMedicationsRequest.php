<?php

namespace App\Http\Requests\Api\Medicamentos;

use App\Http\Requests\Api\ListRequest;

class ListMedicationsRequest extends ListRequest
{
    protected function filterRules(): array
    {
        return [
            'nombre' => ['sometimes', 'string'],
        ];
    }
}
