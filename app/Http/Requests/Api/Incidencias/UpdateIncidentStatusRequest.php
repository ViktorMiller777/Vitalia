<?php

namespace App\Http\Requests\Api\Incidencias;

use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateIncidentStatusRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'estado' => ['required', Rule::in(['Aprobada', 'Rechazada'])],
        ];
    }
}
