<?php

namespace Database\Seeders;

use App\Models\MedicationAdministration;
use App\Models\Prescription;
use App\Models\User;
use Illuminate\Database\Seeder;

class AdministracionMedicamentoSeeder extends Seeder
{
    public function run(): void
    {
        // Obtener cuidadores
        $cuidador1 = User::where('correo', 'cuidador@vitalia.com')->first();
        $cuidador2 = User::where('correo', 'cuidador2@vitalia.com')->first();

        if (!$cuidador1) {
            $cuidador1 = User::where('rol_id', 2)->first();
        }
        if (!$cuidador2) {
            $cuidador2 = User::where('rol_id', 2)->skip(1)->first();
        }

        // Obtener todas las prescripciones activas
        $prescriptions = Prescription::where('estado', 'active')->get();

        $administrations = [];

        // Para cada prescripción, crear algunas administraciones
        foreach ($prescriptions as $prescription) {
            // Administraciones de los últimos 7 días
            for ($i = 0; $i < 3; $i++) {
                $fecha = now()->subDays($i)->setTime(rand(7, 9), rand(0, 59), 0);
                $cuidador = $i % 2 == 0 ? $cuidador1 : $cuidador2;

                $administrations[] = [
                    'prescripcion_id' => $prescription->id,
                    'cuidador_id' => $cuidador ? $cuidador->id : 1,
                    'fecha' => $fecha,
                    'dosis_administrada' => $prescription->dosis,
                    'observaciones' => $this->getRandomObservation(),
                    'created_at' => $fecha,
                    'updated_at' => $fecha,
                ];
            }

            // Una administración más reciente (hoy)
            $fecha = now()->setTime(rand(8, 10), rand(0, 59), 0);
            $administrations[] = [
                'prescripcion_id' => $prescription->id,
                'cuidador_id' => $cuidador1 ? $cuidador1->id : 1,
                'fecha' => $fecha,
                'dosis_administrada' => $prescription->dosis,
                'observaciones' => 'Administración registrada correctamente',
                'created_at' => $fecha,
                'updated_at' => $fecha,
            ];
        }

        // Insertar administraciones
        foreach ($administrations as $admin) {
            MedicationAdministration::create($admin);
        }

        $this->command->info('✅ Administraciones de medicamentos creadas correctamente!');
    }

    private function getRandomObservation(): string
    {
        $observations = [
            'Paciente cooperó adecuadamente',
            'Medicamento administrado sin complicaciones',
            'Paciente presentó leve náusea después de la administración',
            'Se administró con alimentos según indicación',
            'Paciente refiere sentirse mejor después de la dosis',
            'Se registró en el horario programado',
            'Se verificó identidad del paciente antes de administrar',
            'Dosis completa administrada sin incidentes',
            'Paciente dormido, se administró sin despertarlo completamente',
            'Se explicó al paciente el propósito del medicamento',
        ];

        return $observations[array_rand($observations)];
    }
}