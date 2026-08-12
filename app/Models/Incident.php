<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Incident extends Model
{
    use HasFactory;

    protected $table = 'incidencias';

    protected $fillable = [
        'interno_id',
        'cuidador_id',
        'administrador_id',
        'tipo_incidencia',
        'descripcion',
        'prioridad',
        'fecha_hora',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_hora' => 'datetime',
        ];
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'interno_id');
    }

    public function cuidador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'cuidador_id');
    }

    public function administrador(): BelongsTo
    {
        return $this->belongsTo(User::class, 'administrador_id');
    }
}
