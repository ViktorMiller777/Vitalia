<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MedicationAdministration extends Model
{
    use HasFactory;

    protected $table = 'administracion_medicamento';

    protected $fillable = [
        'prescripcion_id',
        'cuidador_id',
        'fecha',
        'dosis_administrada',
        'observaciones',
    ];

    protected function casts(): array
    {
        return [
            'fecha' => 'datetime',
        ];
    }

    public function prescription(): BelongsTo
    {
        return $this->belongsTo(Prescription::class, 'prescripcion_id');
    }

    public function cuidador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cuidador_id');
    }
}
