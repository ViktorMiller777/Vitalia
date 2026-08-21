<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Resident extends Model
{
    use HasFactory;

    protected $table = 'internos';

    protected $fillable = [
        'nombre',
        'apellido_paterno',
        'apellido_materno',
        'fecha_nacimiento',
        'sexo',
        'fecha_ingreso',
        'estado',
    ];

    protected function casts(): array
    {
        return [
            'fecha_nacimiento' => 'date',
            'fecha_ingreso' => 'date',
        ];
    }

    public function clinicalHistory(): HasOne
    {
        return $this->hasOne(ClinicalHistory::class, 'interno_id');
    }

    public function familyLinks(): HasMany
    {
        return $this->hasMany(FamilyLink::class, 'interno_id');
    }

    public function medications(): HasMany
    {
        return $this->hasMany(Prescription::class, 'interno_id');
    }

    public function prescriptions(): HasMany
    {
        return $this->hasMany(Prescription::class, 'interno_id');
    }

    public function alerts(): HasMany
    {
        return $this->hasMany(Alert::class, 'interno_id');
    }

    public function incidents(): HasMany
    {
        return $this->hasMany(Incident::class, 'interno_id');
    }

    public function vitalSigns(): HasMany
    {
        return $this->hasMany(VitalSign::class, 'interno_id');
    }

    public function mediciones(): HasMany
    {
        return $this->hasMany(VitalSign::class, 'interno_id');
    }
}
