<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NotificationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'usuario_id' => $this->usuario_id,
            'interno_id' => $this->interno_id,
            'mensaje' => $this->mensaje,
            'fecha_hora' => optional($this->fecha_hora)->toIso8601String(),
            'estado' => $this->estado,
        ];
    }
}
