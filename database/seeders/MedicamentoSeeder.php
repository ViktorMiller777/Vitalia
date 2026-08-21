<?php

namespace Database\Seeders;

use App\Models\Medication;
use Illuminate\Database\Seeder;

class MedicamentoSeeder extends Seeder
{
    public function run(): void
    {
        $medicamentos = [
            ['nombre' => 'Losartán', 'presentacion' => 'Tableta', 'concentracion' => '50mg'],
            ['nombre' => 'Losartán', 'presentacion' => 'Tableta', 'concentracion' => '100mg'],
            ['nombre' => 'Metformina', 'presentacion' => 'Tableta', 'concentracion' => '500mg'],
            ['nombre' => 'Metformina', 'presentacion' => 'Tableta', 'concentracion' => '850mg'],
            ['nombre' => 'Paracetamol', 'presentacion' => 'Tableta', 'concentracion' => '500mg'],
            ['nombre' => 'Paracetamol', 'presentacion' => 'Tableta', 'concentracion' => '1g'],
            ['nombre' => 'Enalapril', 'presentacion' => 'Tableta', 'concentracion' => '5mg'],
            ['nombre' => 'Enalapril', 'presentacion' => 'Tableta', 'concentracion' => '10mg'],
            ['nombre' => 'Omeprazol', 'presentacion' => 'Cápsula', 'concentracion' => '20mg'],
            ['nombre' => 'Omeprazol', 'presentacion' => 'Cápsula', 'concentracion' => '40mg'],
            ['nombre' => 'Aspirina', 'presentacion' => 'Tableta', 'concentracion' => '100mg'],
            ['nombre' => 'Ibuprofeno', 'presentacion' => 'Tableta', 'concentracion' => '400mg'],
            ['nombre' => 'Ibuprofeno', 'presentacion' => 'Tableta', 'concentracion' => '600mg'],
            ['nombre' => 'Amoxicilina', 'presentacion' => 'Cápsula', 'concentracion' => '500mg'],
            ['nombre' => 'Amoxicilina', 'presentacion' => 'Cápsula', 'concentracion' => '875mg'],
            ['nombre' => 'Atorvastatina', 'presentacion' => 'Tableta', 'concentracion' => '10mg'],
            ['nombre' => 'Atorvastatina', 'presentacion' => 'Tableta', 'concentracion' => '20mg'],
            ['nombre' => 'Insulina', 'presentacion' => 'Inyección', 'concentracion' => '100 UI/ml'],
            ['nombre' => 'Lisinopril', 'presentacion' => 'Tableta', 'concentracion' => '10mg'],
            ['nombre' => 'Levotiroxina', 'presentacion' => 'Tableta', 'concentracion' => '50mcg'],
            ['nombre' => 'Clonazepam', 'presentacion' => 'Tableta', 'concentracion' => '0.5mg'],
            ['nombre' => 'Sertralina', 'presentacion' => 'Tableta', 'concentracion' => '50mg'],
            ['nombre' => 'Tramadol', 'presentacion' => 'Tableta', 'concentracion' => '50mg'],
            ['nombre' => 'Pantoprazol', 'presentacion' => 'Tableta', 'concentracion' => '40mg'],
            ['nombre' => 'Rosuvastatina', 'presentacion' => 'Tableta', 'concentracion' => '10mg'],
        ];

        foreach ($medicamentos as $medicamento) {
            Medication::firstOrCreate(
                ['nombre' => $medicamento['nombre'], 'concentracion' => $medicamento['concentracion']],
                $medicamento
            );
        }

        $this->command->info('✅ Medicamentos creados correctamente!');
    }
}