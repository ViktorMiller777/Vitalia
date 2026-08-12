<?php

namespace App\Http\Requests\Api\Medicamentos;

use App\Exceptions\ApiException;
use App\Http\Requests\Api\ApiFormRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;

class StorePrescriptionRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'medicamento_id' => ['required', 'integer'],
            'dosis' => ['required', 'string', 'max:30'],
            'frecuencia' => ['required', 'string', 'max:30'],
            'fecha_inicio' => ['required', 'date'],
            'fecha_fin' => ['nullable', 'date'],
        ];
    }

    protected function afterValidation(Validator $validator): void
    {
        if (! preg_match('/\S/', (string) $this->input('dosis'))) {
            throw new ApiException('MED-1003', 'El formato de la dosis no es válido', 422);
        }

        if (Carbon::parse($this->input('fecha_inicio'))->startOfDay()->gt(Carbon::today())) {
            throw new ApiException('MED-1008', 'La fecha de inicio no puede ser una fecha futura', 422);
        }

        if ($this->filled('fecha_fin') && Carbon::parse($this->input('fecha_fin'))->lt(Carbon::parse($this->input('fecha_inicio')))) {
            throw new ApiException('MED-1009', 'La fecha de fin no puede ser anterior a la fecha de inicio', 422);
        }
    }
}
