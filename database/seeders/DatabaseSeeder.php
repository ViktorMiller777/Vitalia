<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(RolSeeder::class);

        // User::factory(10)->create();

        User::factory()->create([
            'nombre' => 'María',
            'apellido_paterno' => 'López',
            'apellido_materno' => 'García',
            'correo' => 'admin@vitalia.com',
            'telefono' => '+52 5512345678',
            'usuario' => 'admin.vitalia',
            'rol_id' => Rol::where('nombre', 'Administrador')->value('id'),
            'estado' => 'active',
        ]);
    }
}
