<?php

namespace App\Http\Requests\Api\Alertas;

use App\Http\Requests\Api\ListRequest;
use Illuminate\Validation\Rule;

class ListAlertsRequest extends ListRequest
{
    protected function filterRules(): array
    {
        return [
            'tipo_alerta' => ['sometimes', 'string'],
            'estado' => ['sometimes', Rule::in(['Activa', 'Atendida', 'Descartada'])],
        ];
    }
}
