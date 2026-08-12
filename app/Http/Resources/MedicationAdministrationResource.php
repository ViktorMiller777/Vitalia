<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MedicationAdministrationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'prescripcion_id' => $this->prescripcion_id,
            'cuidador_id' => $this->cuidador_id,
            'fecha' => optional($this->fecha)->toIso8601String(),
            'observaciones' => $this->observaciones,
        ];
    }
}
