<?php

namespace App\Http\Requests\Api\Medicamentos;

use App\Exceptions\ApiException;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreMedicationRequest extends ApiFormRequest
{
    private const PRESENTACIONES = ['Tableta', 'Cápsula', 'Jarabe', 'Inyección', 'Crema', 'Gotas', 'Polvo', 'Suspensión', 'Implante', 'Parche'];

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:100'],
            'presentacion' => ['required', 'string'],
            'concentracion' => ['nullable', 'string', 'max:50'],
        ];
    }

    protected function afterValidation(Validator $validator): void
    {
        if (! in_array($this->input('presentacion'), self::PRESENTACIONES, true)) {
            throw new ApiException('MED-1010', 'La presentación del medicamento no es válida', 422);
        }
    }
}
