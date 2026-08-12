<?php

namespace App\Http\Requests\Api\Internos;

use App\Http\Requests\Api\ListRequest;
use Illuminate\Validation\Rule;

class ListResidentsRequest extends ListRequest
{
    protected function filterRules(): array
    {
        return [
            'estado' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}
