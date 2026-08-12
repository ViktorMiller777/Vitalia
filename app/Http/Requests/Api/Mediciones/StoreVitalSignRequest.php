<?php

namespace App\Http\Requests\Api\Mediciones;

use App\Exceptions\ApiException;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreVitalSignRequest extends ApiFormRequest
{
    private const VITAL_FIELDS = [
        'presion_arterial',
        'frecuencia_cardiaca',
        'temperatura',
        'saturacion_oxigeno',
        'glucosa',
        'calidad_aire',
    ];

    public function rules(): array
    {
        return [
            'presion_arterial' => ['nullable', 'string', 'max:10'],
            'frecuencia_cardiaca' => ['nullable', 'integer'],
            'temperatura' => ['nullable', 'numeric'],
            'saturacion_oxigeno' => ['nullable', 'numeric'],
            'glucosa' => ['nullable', 'numeric'],
            'calidad_aire' => ['nullable', 'integer'],
        ];
    }

    protected function afterValidation(Validator $validator): void
    {
        if (empty(array_filter(self::VITAL_FIELDS, fn ($field) => $this->filled($field)))) {
            throw new ApiException('MDC-1001', 'Ingresa al menos un signo vital', 400);
        }

        if ($this->filled('presion_arterial') && ! preg_match('/^\d{2,3}\/\d{2,3}$/', (string) $this->input('presion_arterial'))) {
            throw new ApiException('MDC-1005', 'El formato de la presión arterial no es válido', 422);
        }

        if ($this->filled('frecuencia_cardiaca') && ! $this->between('frecuencia_cardiaca', 40, 200)) {
            throw new ApiException('MDC-1003', 'El valor ingresado está fuera de un rango fisiológico posible', 422);
        }

        if ($this->filled('temperatura') && ! $this->between('temperatura', 35.0, 42.0)) {
            throw new ApiException('MDC-1003', 'El valor ingresado está fuera de un rango fisiológico posible', 422);
        }

        if ($this->filled('saturacion_oxigeno') && ! $this->between('saturacion_oxigeno', 70, 100)) {
            throw new ApiException('MDC-1003', 'El valor ingresado está fuera de un rango fisiológico posible', 422);
        }

        if ($this->filled('glucosa') && ! $this->between('glucosa', 0, 500)) {
            throw new ApiException('MDC-1003', 'El valor ingresado está fuera de un rango fisiológico posible', 422);
        }
    }

    private function between(string $field, float $min, float $max): bool
    {
        $value = (float) $this->input($field);

        return $value >= $min && $value <= $max;
    }
}
