<?php

namespace App\Http\Requests\Api\Notificaciones;

use App\Http\Requests\Api\ListRequest;
use Illuminate\Validation\Rule;

class ListNotificationsRequest extends ListRequest
{
    protected function filterRules(): array
    {
        return [
            'estado' => ['sometimes', Rule::in(['Pendiente', 'Enviado', 'Leído'])],
        ];
    }
}
