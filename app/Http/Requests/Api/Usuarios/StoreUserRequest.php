<?php

namespace App\Http\Requests\Api\Usuarios;

use App\Exceptions\ApiException;
use App\Http\Requests\Api\ApiFormRequest;
use App\Models\Rol;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;

class StoreUserRequest extends ApiFormRequest
{
    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:50'],
            'apellido_paterno' => ['required', 'string', 'max:50'],
            'apellido_materno' => ['required', 'string', 'max:50'],
            'correo' => ['required', 'string', 'max:100'],
            'telefono' => ['required', 'string'],
            'usuario' => ['required', 'string', 'min:4', 'max:30'],
            'contrasena' => ['required', 'string', 'min:8'],
            'rol_id' => ['required', 'integer'],
        ];
    }

    protected function refForFailedValidation(Validator $validator): array
    {
        return ['USR-1001', 400, 'Completa todos los campos obligatorios'];
    }

    protected function afterValidation(Validator $validator): void
    {
        if (! filter_var($this->input('correo'), FILTER_VALIDATE_EMAIL)) {
            throw new ApiException('USR-1005', 'El formato del correo no es válido', 422);
        }

        if (! preg_match('/^\+52\s?\d{10}$/', (string) $this->input('telefono'))) {
            throw new ApiException('USR-1007', 'El formato del teléfono no es válido', 422);
        }

        if (! preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', (string) $this->input('contrasena'))) {
            throw new ApiException('USR-1006', 'La contraseña no cumple los requisitos mínimos', 422);
        }

        if (! Rol::whereKey($this->input('rol_id'))->exists()) {
            throw new ApiException('USR-1004', 'El rol seleccionado no es válido', 422);
        }

        if (User::where('correo', $this->input('correo'))->exists()) {
            throw new ApiException('USR-1002', 'Este correo ya está registrado', 409);
        }
    }
}
