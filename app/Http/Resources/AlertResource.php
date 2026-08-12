<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AlertResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'interno_id' => $this->interno_id,
            'usuario_id' => $this->usuario_id,
            'tipo_alerta' => $this->tipo_alerta,
            'descripcion' => $this->descripcion,
            'origen' => $this->origen,
            'estado' => $this->estado,
        ];
    }
}
