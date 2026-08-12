<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ResidentResource extends JsonResource
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
            'fecha_nacimiento' => optional($this->fecha_nacimiento)->toDateString(),
            'sexo' => $this->sexo,
            'fecha_ingreso' => optional($this->fecha_ingreso)->toDateString(),
            'estado' => $this->estado,
        ];
    }
}
