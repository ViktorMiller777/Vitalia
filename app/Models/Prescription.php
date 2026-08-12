<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prescription extends Model
{
    use HasFactory;

    protected $table = 'interno_medicamento';

    protected $fillable = [
        'interno_id',
        'medicamento_id',
        'dosis',
        'frecuencia',
        'fecha_inicio',
        'fecha_fin',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_inicio' => 'date',
            'fecha_fin' => 'date',
        ];
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'interno_id');
    }

    public function medication(): BelongsTo
    {
        return $this->belongsTo(Medication::class, 'medicamento_id');
    }

    public function administrations(): HasMany
    {
        return $this->hasMany(MedicationAdministration::class, 'prescripcion_id');
    }
}
