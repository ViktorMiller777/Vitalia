<?php

namespace Database\Seeders;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRol = Rol::where('nombre', 'Administrador')->first();
        $cuidadorRol = Rol::where('nombre', 'Cuidador')->first();
        $familiarRol = Rol::where('nombre', 'Familiar')->first();

        // 1. Administrador: Viktor Miller Miller
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

        // 2. Cuidador: Ricardo Miller Miller
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
    }
}
