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
            'sexo' => ['required', Rule::in(['M', 'F', 'Masculino', 'Femenino', 'Otro'])],
            'fecha_ingreso' => ['nullable', 'date'],
            'estado' => ['nullable', 'string', 'max:50'],

            // Historial clínico
            'tipo_sangre' => ['nullable', 'string', Rule::in(['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])],
            'peso' => ['nullable', 'numeric', 'min:0'],
            'estatura' => ['nullable', 'numeric', 'min:0'],
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
        if ($this->filled('fecha_nacimiento') && Carbon::parse($this->input('fecha_nacimiento'))->age < 60) {
            if ($this->expectsJson() || $this->is('api/*')) {
                throw new ApiException('INT-1006', 'El interno debe ser mayor de 60 años', 422);
            }
            $validator->errors()->add('fecha_nacimiento', 'El interno debe ser mayor de 60 años');
        }

        if ($this->filled('fecha_ingreso') && Carbon::parse($this->input('fecha_ingreso'))->startOfDay()->gt(Carbon::today())) {
            if ($this->expectsJson() || $this->is('api/*')) {
                throw new ApiException('INT-1007', 'La fecha de ingreso no puede ser una fecha futura', 422);
            }
            $validator->errors()->add('fecha_ingreso', 'La fecha de ingreso no puede ser una fecha futura');
        }
    }

    public function fechaIngreso(): string
    {
        return $this->input('fecha_ingreso') ?? Carbon::today()->toDateString();
    }
}
