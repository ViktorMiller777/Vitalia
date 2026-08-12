<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VitalSignResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'interno_id' => $this->interno_id,
            'presion_arterial' => $this->presion_arterial,
            'frecuencia_cardiaca' => $this->frecuencia_cardiaca,
            'temperatura' => $this->temperatura === null ? null : (float) $this->temperatura,
            'saturacion_oxigeno' => $this->saturacion_oxigeno === null ? null : (float) $this->saturacion_oxigeno,
            'glucosa' => $this->glucosa === null ? null : (float) $this->glucosa,
            'calidad_aire' => $this->calidad_aire,
            'created_by' => $this->created_by,
            'created_at' => optional($this->created_at)->toIso8601String(),
            'updated_by' => $this->updated_by,
            'updated_at' => optional($this->updated_at)->toIso8601String(),
        ];
    }
}
