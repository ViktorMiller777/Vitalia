<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FamilyLink extends Model
{
    use HasFactory;

    protected $table = 'interno_familiar';

    protected $fillable = [
        'interno_id',
        'usuario_id',
        'parentesco',
        'fecha_asignacion',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_asignacion' => 'date',
        ];
    }

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'interno_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
