<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ClinicalHistory extends Model
{
    use HasFactory;

    protected $table = 'historial_clinico';

    protected $fillable = [
        'interno_id',
        'tipo_sangre',
        'peso',
        'estatura',
        'alergias',
        'padecimientos',
        'antecedentes_medicos',
        'enfermedades_cronicas',
        'cirugias_previas',
        'observaciones',
        'created_by',
        'updated_by',
    ];

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'interno_id');
    }
}
