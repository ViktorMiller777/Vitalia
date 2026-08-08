<?php

namespace App\Http\Requests\Api\Mediciones;

use App\Http\Requests\Api\ListRequest;

class ListVitalSignsRequest extends ListRequest
{
    protected function filterRules(): array
    {
        return [
            'from' => ['sometimes', 'date'],
            'to' => ['sometimes', 'date'],
        ];
    }
}
