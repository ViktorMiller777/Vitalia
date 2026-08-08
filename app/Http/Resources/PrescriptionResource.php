<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PrescriptionResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'interno_id' => $this->interno_id,
            'medicamento_id' => $this->medicamento_id,
            'dosis' => $this->dosis,
            'frecuencia' => $this->frecuencia,
            'fecha_inicio' => optional($this->fecha_inicio)->toDateString(),
            'fecha_fin' => optional($this->fecha_fin)->toDateString(),
            'estado' => $this->estado,
        ];
    }
}
