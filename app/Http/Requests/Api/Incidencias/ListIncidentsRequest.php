<?php

namespace App\Http\Requests\Api\Incidencias;

use App\Http\Requests\Api\ListRequest;
use Illuminate\Validation\Rule;

class ListIncidentsRequest extends ListRequest
{
    protected function filterRules(): array
    {
        return [
            'estado' => ['sometimes', Rule::in(['Pendiente', 'Aprobada', 'Rechazada'])],
            'prioridad' => ['sometimes', Rule::in(['Baja', 'Media', 'Alta', 'Urgente'])],
        ];
    }
}
