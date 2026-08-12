<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClinicalHistoryResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'interno_id' => $this->interno_id,
            'tipo_sangre' => $this->tipo_sangre,
            'peso' => $this->peso === null ? null : (float) $this->peso,
            'estatura' => $this->estatura === null ? null : (float) $this->estatura,
            'alergias' => $this->alergias,
            'padecimientos' => $this->padecimientos,
            'antecedentes_medicos' => $this->antecedentes_medicos,
            'enfermedades_cronicas' => $this->enfermedades_cronicas,
            'cirugias_previas' => $this->cirugias_previas,
            'observaciones' => $this->observaciones,
            'created_at' => optional($this->created_at)->toIso8601String(),
            'created_by' => $this->created_by,
            'updated_at' => optional($this->updated_at)->toIso8601String(),
            'updated_by' => $this->updated_by,
        ];
    }
}
