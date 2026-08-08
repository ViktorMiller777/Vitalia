<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Alert extends Model
{
    use HasFactory;

    protected $table = 'alertas';

    protected $fillable = [
        'interno_id',
        'usuario_id',
        'tipo_alerta',
        'descripcion',
        'origen',
        'estado',
    ];

    public function resident(): BelongsTo
    {
        return $this->belongsTo(Resident::class, 'interno_id');
    }

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(User::class, 'usuario_id');
    }
}
