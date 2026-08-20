<?php

use App\Http\Controllers\Api\Alertas\AlertController;
use App\Http\Controllers\Api\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Api\Incidencias\IncidentController;
use App\Http\Controllers\Api\Internos\ClinicalHistoryController;
use App\Http\Controllers\Api\Internos\FamilyLinkController;
use App\Http\Controllers\Api\Internos\ResidentController;
use App\Http\Controllers\Api\Medicamentos\AdministrationController;
use App\Http\Controllers\Api\Medicamentos\MedicationController;
use App\Http\Controllers\Api\Medicamentos\PrescriptionController;
use App\Http\Controllers\Api\Mediciones\VitalSignController;
use App\Http\Controllers\Api\Notificaciones\NotificationController;
use App\Http\Controllers\Api\Roles\RoleController;
use App\Http\Controllers\Api\Usuarios\UserController;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', [AuthenticatedSessionController::class, 'destroy']);
        Route::get('me', [AuthenticatedSessionController::class, 'me']);
    });
});

Route::post('internos/{id}/alertas', [AlertController::class, 'store'])
    ->middleware('auth:sanctum,device-key');

Route::post('internos/{id}/mediciones', [VitalSignController::class, 'store'])
    ->middleware('auth:sanctum,device-key');

Route::post('dispositivos/{dispositivoId}/mediciones', [VitalSignController::class, 'storeForDevice']);

Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('roles')->group(function () {
        Route::get('/', [RoleController::class, 'index']);
        Route::get('{id}', [RoleController::class, 'show']);
    });

    Route::prefix('usuarios')->group(function () {
        Route::post('/', [UserController::class, 'store'])->middleware('role:Administrador');
        Route::get('/', [UserController::class, 'index'])->middleware('role:Administrador');
        Route::get('{id}', [UserController::class, 'show']);
        Route::put('{id}', [UserController::class, 'update'])->middleware('role:Administrador');
        Route::delete('{id}', [UserController::class, 'destroy'])->middleware('role:Administrador');
    });

    Route::prefix('internos')->group(function () {
        Route::post('/', [ResidentController::class, 'store'])->middleware('role:Administrador');
        Route::get('/', [ResidentController::class, 'index']);
        Route::get('{id}', [ResidentController::class, 'show']);
        Route::put('{id}', [ResidentController::class, 'update'])->middleware('role:Administrador');
        Route::delete('{id}', [ResidentController::class, 'destroy'])->middleware('role:Administrador');

        Route::prefix('{id}/historial-clinico')->group(function () {
            Route::post('/', [ClinicalHistoryController::class, 'store'])->middleware('role:Administrador');
            Route::get('/', [ClinicalHistoryController::class, 'show']);
            Route::put('/', [ClinicalHistoryController::class, 'update'])->middleware('role:Administrador');
        });

        Route::prefix('{id}/familiares')->group(function () {
            Route::post('/', [FamilyLinkController::class, 'store'])->middleware('role:Administrador');
            Route::get('/', [FamilyLinkController::class, 'index']);
            Route::delete('{usuarioId}', [FamilyLinkController::class, 'destroy'])->middleware('role:Administrador');
        });

        Route::prefix('{id}/medicamentos')->group(function () {
            Route::post('/', [PrescriptionController::class, 'store'])->middleware('role:Administrador');
            Route::get('/', [PrescriptionController::class, 'index']);
            Route::put('{prescripcionId}', [PrescriptionController::class, 'update'])->middleware('role:Administrador');
            Route::delete('{prescripcionId}', [PrescriptionController::class, 'destroy'])->middleware('role:Administrador');

            Route::prefix('{prescripcionId}/administraciones')->group(function () {
                Route::post('/', [AdministrationController::class, 'store'])->middleware('role:Cuidador');
                Route::get('/', [AdministrationController::class, 'index']);
            });
        });

        Route::prefix('{id}/mediciones')->group(function () {
            Route::get('/', [VitalSignController::class, 'index']);
        });

        Route::get('{id}/alertas', [AlertController::class, 'index']);

        Route::prefix('{id}/incidencias')->group(function () {
            Route::post('/', [IncidentController::class, 'store'])->middleware('role:Cuidador');
            Route::get('/', [IncidentController::class, 'index']);
        });
    });

    Route::prefix('medicamentos')->group(function () {
        Route::post('/', [MedicationController::class, 'store'])->middleware('role:Administrador');
        Route::get('/', [MedicationController::class, 'index']);
        Route::get('activos', [MedicationController::class, 'active']);
        Route::get('{id}', [MedicationController::class, 'show']);
        Route::put('{id}', [MedicationController::class, 'update'])->middleware('role:Administrador');
    });

    Route::get('mediciones/{medicionId}', [VitalSignController::class, 'show']);

    Route::get('dispositivos/{dispositivoId}/mediciones/ultima', [VitalSignController::class, 'latestForDevice']);

    Route::prefix('notificaciones')->group(function () {
        Route::get('/', [NotificationController::class, 'index']);
        Route::patch('{id}/leida', [NotificationController::class, 'markRead']);
    });

    Route::prefix('alertas')->group(function () {
        Route::get('{id}', [AlertController::class, 'show']);
        Route::patch('{id}', [AlertController::class, 'updateStatus'])->middleware('role:Administrador');
    });

    Route::prefix('incidencias')->group(function () {
        Route::get('{id}', [IncidentController::class, 'show']);
        Route::put('{id}', [IncidentController::class, 'update'])->middleware('role:Administrador,Cuidador');
        Route::patch('{id}/estado', [IncidentController::class, 'updateStatus'])->middleware('role:Administrador');
    });
});
