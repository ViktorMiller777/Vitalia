<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            RolSeeder::class,
            UserSeeder::class,
            MedicamentoSeeder::class,
            InternoSeeder::class,
            AdministracionMedicamentoSeeder::class,
        ]);
    }
}