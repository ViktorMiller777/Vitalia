<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FamilyLinkResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'usuario_id' => $this->usuario_id,
            'interno_id' => $this->interno_id,
            'nombre' => trim($this->usuario->nombre.' '.$this->usuario->apellido_paterno),
            'parentesco' => $this->parentesco,
            'fecha_asignacion' => optional($this->fecha_asignacion)->toDateString(),
            'estado' => $this->estado,
        ];
    }
}
