<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->nombre,
            'apellido_paterno' => $this->apellido_paterno,
            'apellido_materno' => $this->apellido_materno,
            'correo' => $this->correo,
            'telefono' => $this->telefono,
            'usuario' => $this->usuario,
            'rol_id' => $this->rol_id,
            'estado' => $this->estado,
            'fecha_registro' => optional($this->created_at)->toIso8601String(),
        ];
    }
}
