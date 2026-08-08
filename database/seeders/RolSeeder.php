<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolSeeder extends Seeder
{
    /**
     * Seed the application's roles.
     */
    public function run(): void
    {
        $roles = [
            ['nombre' => 'Administrador', 'descripcion' => 'Acceso total al sistema'],
            ['nombre' => 'Cuidador', 'descripcion' => 'Personal que brinda cuidado directo a los internos'],
            ['nombre' => 'Familiar', 'descripcion' => 'Familiar de un interno con acceso de solo lectura'],
        ];

        foreach ($roles as $rol) {
            Rol::query()->firstOrCreate(['nombre' => $rol['nombre']], $rol);
        }
    }
}
