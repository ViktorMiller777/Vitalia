<?php

namespace App\Http\Requests\Api\Internos;

use App\Exceptions\ApiException;
use App\Http\Requests\Api\ApiFormRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class UpdateResidentRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:50'],
            'apellido_paterno' => ['required', 'string', 'max:50'],
            'apellido_materno' => ['required', 'string', 'max:50'],
            'fecha_nacimiento' => ['required', 'date'],
            'sexo' => ['required', Rule::in(['M', 'F', 'Masculino', 'Femenino'])],
            'fecha_ingreso' => ['nullable', 'date'],
            'estado' => ['nullable', 'string'],
            'tipo_sangre' => ['nullable', 'string', 'max:10'],
            'peso' => ['nullable', 'numeric'],
            'estatura' => ['nullable', 'numeric'],
            'alergias' => ['nullable', 'string'],
            'padecimientos' => ['nullable', 'string'],
            'antecedentes_medicos' => ['nullable', 'string'],
            'enfermedades_cronicas' => ['nullable', 'string'],
            'cirugias_previas' => ['nullable', 'string'],
            'observaciones_generales' => ['nullable', 'string'],
            'observaciones' => ['nullable', 'string'],
        ];
    }

    protected function refForFailedValidation(Validator $validator): array
    {
        return ['INT-1002', 400, 'Completa los datos del interno'];
    }

    protected function afterValidation(Validator $validator): void
    {
        if (Carbon::parse($this->input('fecha_nacimiento'))->age <= 60) {
            throw new ApiException('INT-1006', 'El interno debe ser mayor de 60 años', 422);
        }

        if ($this->filled('fecha_ingreso') && Carbon::parse($this->input('fecha_ingreso'))->startOfDay()->gt(Carbon::today())) {
            throw new ApiException('INT-1007', 'La fecha de ingreso no puede ser una fecha futura', 422);
        }
    }
}
