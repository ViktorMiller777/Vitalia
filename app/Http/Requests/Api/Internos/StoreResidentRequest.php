<?php

namespace App\Http\Requests\Api\Internos;

use App\Exceptions\ApiException;
use App\Http\Requests\Api\ApiFormRequest;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\Rule;

class StoreResidentRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:50'],
            'apellido_paterno' => ['required', 'string', 'max:50'],
            'apellido_materno' => ['required', 'string', 'max:50'],
            'fecha_nacimiento' => ['required', 'date'],
            'sexo' => ['required', Rule::in(['M', 'F'])],
            'fecha_ingreso' => ['nullable', 'date'],
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

    public function fechaIngreso(): string
    {
        return $this->input('fecha_ingreso') ?? Carbon::today()->toDateString();
    }
}
