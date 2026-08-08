<?php

namespace App\Http\Requests\Api\Usuarios;

use App\Http\Requests\Api\ListRequest;
use Illuminate\Validation\Rule;

class ListUsersRequest extends ListRequest
{
    protected function filterRules(): array
    {
        return [
            'estado' => ['sometimes', Rule::in(['active', 'inactive'])],
        ];
    }
}
