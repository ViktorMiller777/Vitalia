<?php

namespace App\Http\Requests\Api\Alertas;

use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Validation\Rule;

class UpdateAlertStatusRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'estado' => ['required', Rule::in(['Atendida', 'Descartada'])],
        ];
    }
}
