<?php

namespace App\Http\Requests\Api\Internos;

use App\Exceptions\ApiException;
use App\Http\Requests\Api\ApiFormRequest;
use Illuminate\Contracts\Validation\Validator;

class StoreFamilyLinkRequest extends ApiFormRequest
{
    private const PARENTESCOS = ['Hijo(a)', 'Esposo(a)', 'Hermano(a)', 'Tutor(a) legal', 'Cónyuge', 'Otro'];

    public function rules(): array
    {
        return [
            'usuario_id' => ['required', 'integer', 'exists:users,id'],
            'parentesco' => ['required', 'string'],
        ];
    }

    protected function afterValidation(Validator $validator): void
    {
        if (! in_array($this->input('parentesco'), self::PARENTESCOS, true)) {
            throw new ApiException('INT-1008', 'El parentesco seleccionado no es válido', 422);
        }
    }
}
