<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IncidentResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'interno_id' => $this->interno_id,
            'cuidador_id' => $this->cuidador_id,
            'administrador_id' => $this->administrador_id,
            'tipo_incidencia' => $this->tipo_incidencia,
            'descripcion' => $this->descripcion,
            'prioridad' => $this->prioridad,
            'fecha_hora' => optional($this->fecha_hora)->toIso8601String(),
            'estado' => $this->estado,
        ];
    }
}
