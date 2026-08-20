<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class VitalSign extends Model
{
    use HasFactory;

    protected $table = 'mediciones';

    protected $fillable = [
        'interno_id',
        'dispositivo_id',
        'presion_arterial',
        'frecuencia_cardiaca',
        'temperatura',
        'saturacion_oxigeno',
        'glucosa',
        'calidad_aire',
        'created_by',
        'updated_by',
    ];

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'interno_id');
    }
}
