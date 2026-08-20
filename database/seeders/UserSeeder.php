<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * Las contraseñas se toman de SEED_ADMIN_PASSWORD / SEED_CUIDADOR_PASSWORD.
     * Si no se definen, se genera una contraseña aleatoria y se imprime en
     * consola, para no dejar credenciales adivinables en el repositorio.
     */
    public function run(): void
    {
        $adminRol = Rol::where('nombre', 'Administrador')->first();
        $cuidadorRol = Rol::where('nombre', 'Cuidador')->first();
        $familiarRol = Rol::where('nombre', 'Familiar')->first();

        // 1. Administrador: Viktor Miller Miller
        $adminExists = User::where('correo', 'admin@vitalia.com')->exists();
        $adminPassword = env('SEED_ADMIN_PASSWORD') ?: Str::password(20);

        User::firstOrCreate(
            ['correo' => 'admin@vitalia.com'],
            [
                'nombre' => 'Viktor',
                'apellido_paterno' => 'Miller',
                'apellido_materno' => 'Miller',
                'correo' => 'admin@vitalia.com',
                'telefono' => '+52 5512345678',
                'usuario' => 'viktor.miller',
                'password' => Hash::make($adminPassword),
                'rol_id' => $adminRol ? $adminRol->id : 1,
                'estado' => 'active',
            ]
        );

        if (! $adminExists && ! env('SEED_ADMIN_PASSWORD')) {
            $this->command?->warn("Usuario admin@vitalia.com creado con contraseña temporal: {$adminPassword}");
        }

        // 2. Cuidador: Ricardo Miller Miller
        $cuidadorExists = User::where('correo', 'cuidador@vitalia.com')->exists();
        $cuidadorPassword = env('SEED_CUIDADOR_PASSWORD') ?: Str::password(20);

        User::firstOrCreate(
            ['correo' => 'cuidador@vitalia.com'],
            [
                'nombre' => 'Ricardo',
                'apellido_paterno' => 'Miller',
                'apellido_materno' => 'Miller',
                'correo' => 'cuidador@vitalia.com',
                'telefono' => '+52 5512345679',
                'usuario' => 'ricardo.miller',
                'password' => Hash::make($cuidadorPassword),
                'rol_id' => $cuidadorRol ? $cuidadorRol->id : 2,
                'estado' => 'active',
            ]
        );

        if (! $cuidadorExists && ! env('SEED_CUIDADOR_PASSWORD')) {
            $this->command?->warn("Usuario cuidador@vitalia.com creado con contraseña temporal: {$cuidadorPassword}");
        }
    }
}
