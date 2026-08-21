<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $adminRol = Rol::where('nombre', 'Administrador')->first();
        $cuidadorRol = Rol::where('nombre', 'Cuidador')->first();
        $familiarRol = Rol::where('nombre', 'Familiar')->first();

        // 1. Administrador
        User::firstOrCreate(
            ['correo' => 'admin@vitalia.com'],
            [
                'nombre' => 'Viktor',
                'apellido_paterno' => 'Miller',
                'apellido_materno' => 'Miller',
                'correo' => 'admin@vitalia.com',
                'telefono' => '+52 5512345678',
                'usuario' => 'viktor.miller',
                'password' => Hash::make('123456789'),
                'rol_id' => $adminRol ? $adminRol->id : 1,
                'estado' => 'active',
            ]
        );

        // 2. Cuidador principal
        User::firstOrCreate(
            ['correo' => 'cuidador@vitalia.com'],
            [
                'nombre' => 'Ricardo',
                'apellido_paterno' => 'Miller',
                'apellido_materno' => 'Miller',
                'correo' => 'cuidador@vitalia.com',
                'telefono' => '+52 5512345679',
                'usuario' => 'ricardo.miller',
                'password' => Hash::make('123456789'),
                'rol_id' => $cuidadorRol ? $cuidadorRol->id : 2,
                'estado' => 'active',
            ]
        );

        // 3. Otro cuidador
        User::firstOrCreate(
            ['correo' => 'cuidador2@vitalia.com'],
            [
                'nombre' => 'Laura',
                'apellido_paterno' => 'Gómez',
                'apellido_materno' => 'Sánchez',
                'correo' => 'cuidador2@vitalia.com',
                'telefono' => '+52 5512345680',
                'usuario' => 'laura.gomez',
                'password' => Hash::make('123456789'),
                'rol_id' => $cuidadorRol ? $cuidadorRol->id : 2,
                'estado' => 'active',
            ]
        );

        // 4. Familiar de Juan Pérez
        User::firstOrCreate(
            ['correo' => 'familiar1@vitalia.com'],
            [
                'nombre' => 'Ana',
                'apellido_paterno' => 'Pérez',
                'apellido_materno' => 'Martínez',
                'correo' => 'familiar1@vitalia.com',
                'telefono' => '+52 5512345681',
                'usuario' => 'ana.perez',
                'password' => Hash::make('123456789'),
                'rol_id' => $familiarRol ? $familiarRol->id : 3,
                'estado' => 'active',
            ]
        );

        // 5. Familiar de María González
        User::firstOrCreate(
            ['correo' => 'familiar2@vitalia.com'],
            [
                'nombre' => 'Carlos',
                'apellido_paterno' => 'González',
                'apellido_materno' => 'López',
                'correo' => 'familiar2@vitalia.com',
                'telefono' => '+52 5512345682',
                'usuario' => 'carlos.gonzalez',
                'password' => Hash::make('123456789'),
                'rol_id' => $familiarRol ? $familiarRol->id : 3,
                'estado' => 'active',
            ]
        );
    }
}