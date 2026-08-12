<?php

namespace App\Http\Requests\Api\Medicamentos;

use App\Http\Requests\Api\ListRequest;
use Illuminate\Validation\Rule;

class ListPrescriptionsRequest extends ListRequest
{
    protected function filterRules(): array
    {
        return [
            'estado' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}
