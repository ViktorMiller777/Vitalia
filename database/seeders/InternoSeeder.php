<?php

namespace Database\Seeders;

use App\Models\Resident;
use App\Models\ClinicalHistory;
use App\Models\Medication;
use App\Models\Prescription;
use App\Models\VitalSign;
use App\Models\FamilyLink;
use App\Models\User;
use App\Models\Alert;
use App\Models\Incident;
use Illuminate\Database\Seeder;

class InternoSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(MedicamentoSeeder::class);

        $internos = [
            [
                'nombre' => 'Juan',
                'apellido_paterno' => 'Pérez',
                'apellido_materno' => 'González',
                'fecha_nacimiento' => '1947-03-12',
                'sexo' => 'M',
                'fecha_ingreso' => '2025-03-15',
                'estado' => 'active',
                'clinical_history' => [
                    'tipo_sangre' => 'A+',
                    'peso' => 72.5,
                    'estatura' => 168,
                    'alergias' => 'Penicilina',
                    'padecimientos' => 'Hipertensión arterial',
                    'antecedentes_medicos' => 'Hipertensión diagnosticada hace 10 años',
                    'enfermedades_cronicas' => 'Hipertensión arterial',
                    'cirugias_previas' => 'Ninguna',
                    'observaciones' => 'Paciente estable, requiere control mensual'
                ],
                'prescriptions' => [
                    [
                        'medicamento_nombre' => 'Losartán',
                        'dosis' => '50mg',
                        'frecuencia' => 'Cada 12 horas',
                        'fecha_inicio' => '2025-03-15',
                        'fecha_fin' => null,
                        'estado' => 'active'
                    ],
                    [
                        'medicamento_nombre' => 'Metformina',
                        'dosis' => '850mg',
                        'frecuencia' => 'Cada 8 horas',
                        'fecha_inicio' => '2025-03-15',
                        'fecha_fin' => null,
                        'estado' => 'active'
                    ]
                ],
                'vital_signs' => [
                    [
                        'presion_arterial' => '120/80',
                        'frecuencia_cardiaca' => 72,
                        'temperatura' => 36.5,
                        'saturacion_oxigeno' => 98,
                        'glucosa' => 110,
                        'calidad_aire' => 45,
                        'created_at' => now()->subDays(2)
                    ],
                    [
                        'presion_arterial' => '118/78',
                        'frecuencia_cardiaca' => 70,
                        'temperatura' => 36.3,
                        'saturacion_oxigeno' => 99,
                        'glucosa' => 105,
                        'calidad_aire' => 42,
                        'created_at' => now()->subDays(5)
                    ]
                ],
                'family_links' => [
                    ['usuario_correo' => 'familiar1@vitalia.com', 'parentesco' => 'Hijo(a)']
                ],
                // MÚLTIPLES ALERTAS CON DIFERENTES FECHAS
                'alerts' => [
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Media',
                        'descripcion' => 'Presión arterial elevada detectada (145/95)',
                        'origen' => 'Medición automática',
                        'estado' => 'Activa',
                        'created_at' => now()->subDays(1)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Baja',
                        'descripcion' => 'Glucosa ligeramente elevada (130 mg/dL)',
                        'origen' => 'Monitoreo continuo',
                        'estado' => 'Atendida',
                        'created_at' => now()->subDays(3)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Media',
                        'descripcion' => 'Frecuencia cardíaca elevada (95 lpm)',
                        'origen' => 'Medición automática',
                        'estado' => 'Activa',
                        'created_at' => now()->subDays(5)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Baja',
                        'descripcion' => 'Temperatura ligeramente elevada (37.2°C)',
                        'origen' => 'Monitoreo continuo',
                        'estado' => 'Descartada',
                        'created_at' => now()->subDays(7)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Media',
                        'descripcion' => 'Presión arterial elevada (142/92)',
                        'origen' => 'Medición automática',
                        'estado' => 'Atendida',
                        'created_at' => now()->subDays(10)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Baja',
                        'descripcion' => 'Leve aumento de glucosa (125 mg/dL)',
                        'origen' => 'Monitoreo continuo',
                        'estado' => 'Activa',
                        'created_at' => now()->subDays(14)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Media',
                        'descripcion' => 'Saturación de oxígeno baja (92%)',
                        'origen' => 'Medición automática',
                        'estado' => 'Descartada',
                        'created_at' => now()->subDays(20)
                    ]
                ],
                'incidents' => [
                    [
                        'cuidador_correo' => 'cuidador@vitalia.com',
                        'tipo_incidencia' => 'Caída',
                        'descripcion' => 'El interno presentó una caída leve al levantarse de la cama',
                        'prioridad' => 'Media',
                        'fecha_hora' => now()->subHours(2),
                        'estado' => 'Pendiente'
                    ]
                ]
            ],
            [
                'nombre' => 'María',
                'apellido_paterno' => 'González',
                'apellido_materno' => 'López',
                'fecha_nacimiento' => '1952-08-25',
                'sexo' => 'F',
                'fecha_ingreso' => '2025-02-10',
                'estado' => 'active',
                'clinical_history' => [
                    'tipo_sangre' => 'B+',
                    'peso' => 65.0,
                    'estatura' => 160,
                    'alergias' => 'Ninguna',
                    'padecimientos' => 'Diabetes tipo 2',
                    'antecedentes_medicos' => 'Diabetes diagnosticada hace 5 años',
                    'enfermedades_cronicas' => 'Diabetes tipo 2',
                    'cirugias_previas' => 'Ninguna',
                    'observaciones' => 'Paciente con diabetes, requiere monitoreo constante'
                ],
                'prescriptions' => [
                    [
                        'medicamento_nombre' => 'Metformina',
                        'dosis' => '850mg',
                        'frecuencia' => 'Cada 12 horas',
                        'fecha_inicio' => '2025-02-10',
                        'fecha_fin' => null,
                        'estado' => 'active'
                    ]
                ],
                'vital_signs' => [
                    [
                        'presion_arterial' => '145/95',
                        'frecuencia_cardiaca' => 88,
                        'temperatura' => 38.2,
                        'saturacion_oxigeno' => 94,
                        'glucosa' => 160,
                        'calidad_aire' => 52,
                        'created_at' => now()->subDays(1)
                    ],
                    [
                        'presion_arterial' => '140/90',
                        'frecuencia_cardiaca' => 85,
                        'temperatura' => 37.8,
                        'saturacion_oxigeno' => 95,
                        'glucosa' => 155,
                        'calidad_aire' => 50,
                        'created_at' => now()->subDays(3)
                    ]
                ],
                'family_links' => [
                    ['usuario_correo' => 'familiar2@vitalia.com', 'parentesco' => 'Hermano(a)']
                ],
                'alerts' => [
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Crítica',
                        'descripcion' => 'Glucosa elevada (160 mg/dL) y fiebre (38.2°C)',
                        'origen' => 'Monitoreo continuo',
                        'estado' => 'Activa',
                        'created_at' => now()->subDays(1)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Media',
                        'descripcion' => 'Presión arterial elevada (145/95)',
                        'origen' => 'Medición automática',
                        'estado' => 'Activa',
                        'created_at' => now()->subDays(2)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Baja',
                        'descripcion' => 'Glucosa moderadamente elevada (140 mg/dL)',
                        'origen' => 'Monitoreo continuo',
                        'estado' => 'Atendida',
                        'created_at' => now()->subDays(4)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Media',
                        'descripcion' => 'Frecuencia cardíaca elevada (92 lpm)',
                        'origen' => 'Medición automática',
                        'estado' => 'Descartada',
                        'created_at' => now()->subDays(6)
                    ]
                ],
                'incidents' => [
                    [
                        'cuidador_correo' => 'cuidador2@vitalia.com',
                        'tipo_incidencia' => 'Síntoma',
                        'descripcion' => 'Paciente presenta dolor de cabeza persistente y mareos',
                        'prioridad' => 'Alta',
                        'fecha_hora' => now()->subHours(4),
                        'estado' => 'Pendiente'
                    ]
                ]
            ],
            [
                'nombre' => 'Carlos',
                'apellido_paterno' => 'Ruiz',
                'apellido_materno' => 'Martínez',
                'fecha_nacimiento' => '1966-11-03',
                'sexo' => 'M',
                'fecha_ingreso' => '2025-01-20',
                'estado' => 'active',
                'clinical_history' => [
                    'tipo_sangre' => 'O+',
                    'peso' => 80.0,
                    'estatura' => 175,
                    'alergias' => 'Ibuprofeno',
                    'padecimientos' => 'Hipertensión, Diabetes tipo 2',
                    'antecedentes_medicos' => 'Hipertensión y diabetes diagnosticadas',
                    'enfermedades_cronicas' => 'Hipertensión arterial, Diabetes tipo 2',
                    'cirugias_previas' => 'Apéndice (2010)',
                    'observaciones' => 'Paciente en estado crítico, requiere atención inmediata'
                ],
                'prescriptions' => [
                    [
                        'medicamento_nombre' => 'Losartán',
                        'dosis' => '50mg',
                        'frecuencia' => 'Cada 12 horas',
                        'fecha_inicio' => '2025-01-20',
                        'fecha_fin' => null,
                        'estado' => 'active'
                    ],
                    [
                        'medicamento_nombre' => 'Metformina',
                        'dosis' => '850mg',
                        'frecuencia' => 'Cada 8 horas',
                        'fecha_inicio' => '2025-01-20',
                        'fecha_fin' => null,
                        'estado' => 'active'
                    ],
                    [
                        'medicamento_nombre' => 'Paracetamol',
                        'dosis' => '500mg',
                        'frecuencia' => 'Cada 6 horas',
                        'fecha_inicio' => '2025-06-15',
                        'fecha_fin' => '2025-06-25',
                        'estado' => 'inactive'
                    ]
                ],
                'vital_signs' => [
                    [
                        'presion_arterial' => '150/95',
                        'frecuencia_cardiaca' => 92,
                        'temperatura' => 37.8,
                        'saturacion_oxigeno' => 92,
                        'glucosa' => 180,
                        'calidad_aire' => 60,
                        'created_at' => now()->subHours(4)
                    ],
                    [
                        'presion_arterial' => '155/98',
                        'frecuencia_cardiaca' => 95,
                        'temperatura' => 38.0,
                        'saturacion_oxigeno' => 90,
                        'glucosa' => 185,
                        'calidad_aire' => 65,
                        'created_at' => now()->subHours(8)
                    ]
                ],
                'family_links' => [],
                'alerts' => [
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Crítica',
                        'descripcion' => 'Valores críticos: Presión 155/98, Glucosa 185, Saturación O2 90%',
                        'origen' => 'Monitoreo continuo',
                        'estado' => 'Activa',
                        'created_at' => now()->subHours(4)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Media',
                        'descripcion' => 'Presión arterial elevada (150/95)',
                        'origen' => 'Medición automática',
                        'estado' => 'Activa',
                        'created_at' => now()->subHours(6)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Crítica',
                        'descripcion' => 'Saturación de oxígeno peligrosamente baja (88%)',
                        'origen' => 'Monitoreo continuo',
                        'estado' => 'Atendida',
                        'created_at' => now()->subHours(12)
                    ]
                ],
                'incidents' => []
            ],
            [
                'nombre' => 'Ana',
                'apellido_paterno' => 'López',
                'apellido_materno' => 'Pérez',
                'fecha_nacimiento' => '1959-05-17',
                'sexo' => 'F',
                'fecha_ingreso' => '2025-04-01',
                'estado' => 'active',
                'clinical_history' => [
                    'tipo_sangre' => 'AB-',
                    'peso' => 58.5,
                    'estatura' => 155,
                    'alergias' => 'Ninguna',
                    'padecimientos' => 'Ninguno',
                    'antecedentes_medicos' => 'Sin antecedentes relevantes',
                    'enfermedades_cronicas' => 'Ninguna',
                    'cirugias_previas' => 'Ninguna',
                    'observaciones' => 'Paciente en buen estado general'
                ],
                'prescriptions' => [
                    [
                        'medicamento_nombre' => 'Enalapril',
                        'dosis' => '10mg',
                        'frecuencia' => 'Cada 24 horas',
                        'fecha_inicio' => '2025-04-01',
                        'fecha_fin' => null,
                        'estado' => 'active'
                    ]
                ],
                'vital_signs' => [
                    [
                        'presion_arterial' => '125/82',
                        'frecuencia_cardiaca' => 70,
                        'temperatura' => 36.8,
                        'saturacion_oxigeno' => 97,
                        'glucosa' => 105,
                        'calidad_aire' => 40,
                        'created_at' => now()->subDays(1)
                    ]
                ],
                'family_links' => [],
                'alerts' => [
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Baja',
                        'descripcion' => 'Leve aumento de la presión arterial (135/85)',
                        'origen' => 'Medición automática',
                        'estado' => 'Activa',
                        'created_at' => now()->subDays(3)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Baja',
                        'descripcion' => 'Glucosa ligeramente elevada (115 mg/dL)',
                        'origen' => 'Monitoreo continuo',
                        'estado' => 'Descartada',
                        'created_at' => now()->subDays(7)
                    ]
                ],
                'incidents' => []
            ],
            [
                'nombre' => 'Roberto',
                'apellido_paterno' => 'Martínez',
                'apellido_materno' => 'García',
                'fecha_nacimiento' => '1954-09-28',
                'sexo' => 'M',
                'fecha_ingreso' => '2025-05-10',
                'estado' => 'active',
                'clinical_history' => [
                    'tipo_sangre' => 'A-',
                    'peso' => 75.0,
                    'estatura' => 170,
                    'alergias' => 'Penicilina',
                    'padecimientos' => 'Hipertensión',
                    'antecedentes_medicos' => 'Hipertensión controlada',
                    'enfermedades_cronicas' => 'Hipertensión arterial',
                    'cirugias_previas' => 'Próstata (2018)',
                    'observaciones' => 'Paciente estable, control periódico'
                ],
                'prescriptions' => [
                    [
                        'medicamento_nombre' => 'Omeprazol',
                        'dosis' => '20mg',
                        'frecuencia' => 'Cada 24 horas',
                        'fecha_inicio' => '2025-05-10',
                        'fecha_fin' => null,
                        'estado' => 'active'
                    ]
                ],
                'vital_signs' => [
                    [
                        'presion_arterial' => '135/85',
                        'frecuencia_cardiaca' => 76,
                        'temperatura' => 37.1,
                        'saturacion_oxigeno' => 96,
                        'glucosa' => 125,
                        'calidad_aire' => 48,
                        'created_at' => now()->subDays(2)
                    ]
                ],
                'family_links' => [],
                'alerts' => [
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Media',
                        'descripcion' => 'Presión arterial elevada (145/90)',
                        'origen' => 'Medición automática',
                        'estado' => 'Activa',
                        'created_at' => now()->subDays(5)
                    ],
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Baja',
                        'descripcion' => 'Glucosa moderadamente elevada (130 mg/dL)',
                        'origen' => 'Monitoreo continuo',
                        'estado' => 'Atendida',
                        'created_at' => now()->subDays(10)
                    ]
                ],
                'incidents' => []
            ],
            [
                'nombre' => 'Pedro',
                'apellido_paterno' => 'Ramírez',
                'apellido_materno' => 'Torres',
                'fecha_nacimiento' => '1960-12-01',
                'sexo' => 'M',
                'fecha_ingreso' => '2024-08-15',
                'estado' => 'inactive',
                'clinical_history' => [
                    'tipo_sangre' => 'O-',
                    'peso' => 70.0,
                    'estatura' => 165,
                    'alergias' => 'Ninguna',
                    'padecimientos' => 'Hipertensión',
                    'antecedentes_medicos' => 'Hipertensión controlada',
                    'enfermedades_cronicas' => 'Hipertensión arterial',
                    'cirugias_previas' => 'Ninguna',
                    'observaciones' => 'Paciente dado de baja'
                ],
                'prescriptions' => [
                    [
                        'medicamento_nombre' => 'Losartán',
                        'dosis' => '50mg',
                        'frecuencia' => 'Cada 12 horas',
                        'fecha_inicio' => '2024-08-15',
                        'fecha_fin' => '2025-06-30',
                        'estado' => 'inactive'
                    ]
                ],
                'vital_signs' => [
                    [
                        'presion_arterial' => '130/85',
                        'frecuencia_cardiaca' => 75,
                        'temperatura' => 36.7,
                        'saturacion_oxigeno' => 97,
                        'glucosa' => 115,
                        'calidad_aire' => 43,
                        'created_at' => now()->subDays(30)
                    ]
                ],
                'family_links' => [],
                'alerts' => [
                    [
                        'usuario_correo' => 'cuidador@vitalia.com',
                        'tipo_alerta' => 'Baja',
                        'descripcion' => 'Presión arterial elevada (140/90)',
                        'origen' => 'Medición automática',
                        'estado' => 'Descartada',
                        'created_at' => now()->subDays(45)
                    ]
                ],
                'incidents' => []
            ]
        ];

        foreach ($internos as $data) {
            // Crear interno
            $resident = Resident::create([
                'nombre' => $data['nombre'],
                'apellido_paterno' => $data['apellido_paterno'],
                'apellido_materno' => $data['apellido_materno'],
                'fecha_nacimiento' => $data['fecha_nacimiento'],
                'sexo' => $data['sexo'],
                'fecha_ingreso' => $data['fecha_ingreso'],
                'estado' => $data['estado'],
            ]);

            // Crear historial clínico
            if (isset($data['clinical_history'])) {
                ClinicalHistory::create([
                    'interno_id' => $resident->id,
                    'tipo_sangre' => $data['clinical_history']['tipo_sangre'],
                    'peso' => $data['clinical_history']['peso'],
                    'estatura' => $data['clinical_history']['estatura'],
                    'alergias' => $data['clinical_history']['alergias'],
                    'padecimientos' => $data['clinical_history']['padecimientos'],
                    'antecedentes_medicos' => $data['clinical_history']['antecedentes_medicos'],
                    'enfermedades_cronicas' => $data['clinical_history']['enfermedades_cronicas'],
                    'cirugias_previas' => $data['clinical_history']['cirugias_previas'],
                    'observaciones' => $data['clinical_history']['observaciones'],
                ]);
            }

            // Crear prescripciones
            if (isset($data['prescriptions'])) {
                foreach ($data['prescriptions'] as $prescriptionData) {
                    $medication = Medication::where('nombre', 'LIKE', $prescriptionData['medicamento_nombre'] . '%')
                        ->where('concentracion', $prescriptionData['dosis'])
                        ->first();
                    
                    if (!$medication) {
                        $medication = Medication::where('nombre', 'LIKE', $prescriptionData['medicamento_nombre'] . '%')->first();
                    }
                    
                    if ($medication) {
                        Prescription::create([
                            'interno_id' => $resident->id,
                            'medicamento_id' => $medication->id,
                            'dosis' => $prescriptionData['dosis'],
                            'frecuencia' => $prescriptionData['frecuencia'],
                            'fecha_inicio' => $prescriptionData['fecha_inicio'],
                            'fecha_fin' => $prescriptionData['fecha_fin'],
                            'estado' => $prescriptionData['estado'],
                        ]);
                    }
                }
            }

            // Crear signos vitales
            if (isset($data['vital_signs'])) {
                foreach ($data['vital_signs'] as $signData) {
                    VitalSign::create([
                        'interno_id' => $resident->id,
                        'presion_arterial' => $signData['presion_arterial'],
                        'frecuencia_cardiaca' => $signData['frecuencia_cardiaca'],
                        'temperatura' => $signData['temperatura'],
                        'saturacion_oxigeno' => $signData['saturacion_oxigeno'],
                        'glucosa' => $signData['glucosa'],
                        'calidad_aire' => $signData['calidad_aire'],
                        'created_at' => $signData['created_at'] ?? now(),
                        'updated_at' => $signData['created_at'] ?? now(),
                    ]);
                }
            }

            // Crear FamilyLinks
            if (isset($data['family_links'])) {
                foreach ($data['family_links'] as $linkData) {
                    $user = User::where('correo', $linkData['usuario_correo'])->first();
                    if ($user) {
                        FamilyLink::create([
                            'interno_id' => $resident->id,
                            'usuario_id' => $user->id,
                            'parentesco' => $linkData['parentesco'],
                            'fecha_asignacion' => now()->toDateString(),
                            'estado' => 'active',
                        ]);
                    }
                }
            }

            // CREAR ALERTAS CON created_at PERSONALIZADO
            if (isset($data['alerts'])) {
                foreach ($data['alerts'] as $alertData) {
                    $user = User::where('correo', $alertData['usuario_correo'])->first();
                    $alert = Alert::create([
                        'interno_id' => $resident->id,
                        'usuario_id' => $user ? $user->id : null,
                        'tipo_alerta' => $alertData['tipo_alerta'],
                        'descripcion' => $alertData['descripcion'],
                        'origen' => $alertData['origen'],
                        'estado' => $alertData['estado'],
                        'created_at' => $alertData['created_at'] ?? now(),
                        'updated_at' => $alertData['created_at'] ?? now(),
                    ]);
                }
            }

            // Crear Incidencias
            if (isset($data['incidents'])) {
                foreach ($data['incidents'] as $incidentData) {
                    $cuidador = User::where('correo', $incidentData['cuidador_correo'])->first();
                    Incident::create([
                        'interno_id' => $resident->id,
                        'cuidador_id' => $cuidador ? $cuidador->id : null,
                        'tipo_incidencia' => $incidentData['tipo_incidencia'],
                        'descripcion' => $incidentData['descripcion'],
                        'prioridad' => $incidentData['prioridad'],
                        'fecha_hora' => $incidentData['fecha_hora'],
                        'estado' => $incidentData['estado'],
                    ]);
                }
            }
        }

        $this->command->info('✅ Internos creados correctamente!');
    }
}