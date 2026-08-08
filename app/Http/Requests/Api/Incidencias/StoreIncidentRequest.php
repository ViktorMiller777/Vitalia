<?php

namespace App\Http\Requests\Api\Incidencias;

use App\Exceptions\ApiException;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreIncidentRequest extends ApiFormRequest
{
    private const PRIORIDADES = ['Baja', 'Media', 'Alta', 'Urgente'];

    public function rules(): array
    {
        return [
            'tipo_incidencia' => ['required', 'string', 'max:30'],
            'descripcion' => ['required', 'string'],
            'prioridad' => ['sometimes', 'string'],
        ];
    }

    protected function refForFailedValidation(Validator $validator): array
    {
        return ['INC-1004', 400, 'Completa el tipo de incidencia y la descripción'];
    }

    protected function afterValidation(Validator $validator): void
    {
        if ($this->filled('prioridad') && ! in_array($this->input('prioridad'), self::PRIORIDADES, true)) {
            throw new ApiException('INC-1002', 'La prioridad seleccionada no es válida', 422);
        }
    }

    public function prioridad(): string
    {
        return $this->input('prioridad', 'Media');
    }
}
