<?php

use App\Http\Controllers\Api\Internos\ResidentController;
use App\Http\Controllers\Api\Usuarios\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//DASHBOARD DEL ADMINISTRADOR
Route::get('/dashboard',function(){
    return view('dashboard');
})->name('dashboard');

//VISTAS DE INTERNOS(ADMIN)
Route::get('/internos', [ResidentController::class, 'index'])->name('internos.index');

Route::get('/agregar-internos', function () {
    return view('internos.agregar_interno'); 
})->name('internos.create');

Route::post('/agregar-internos', [ResidentController::class, 'store'])->name('internos.store');

Route::get('/detalle-interno/{id}', [ResidentController::class, 'show'])->name('internos.detalle_interno');

Route::get('/editar-interno/{id}', [ResidentController::class, 'edit'])->name('internos.editar_interno');
Route::put('/editar-interno/{id}', [ResidentController::class, 'update'])->name('internos.update');

//VISTAS DE CUIDADORES(ADMIN)
Route::get('/cuidadores', [UserController::class, 'cuidadoresIndex'])->name('cuidadores.index');

Route::get('/agregar-cuidador', [UserController::class, 'cuidadorCreate'])->name('cuidadores.create');
Route::post('/agregar-cuidador', [UserController::class, 'cuidadorStore'])->name('cuidadores.store');

Route::get('/detalle-cuidador/{id}', [UserController::class, 'cuidadorShow'])->name('cuidadores.detalle_cuidador');

Route::get('/editar-cuidador/{id?}', [UserController::class, 'cuidadorEdit'])->name('cuidadores.editar_cuidador');
Route::put('/editar-cuidador/{id}', [UserController::class, 'cuidadorUpdate'])->name('cuidadores.update');

//VISTAS DE FAMILIARES(ADMIN)

Route::get('/familiares', [UserController::class, 'familiaresIndex'])->name('familiares.index');

Route::get('/agregar-familiar', [UserController::class, 'familiarCreate'])->name('familiar.create');
Route::post('/agregar-familiar', [UserController::class, 'familiarStore'])->name('familiar.store');

Route::get('/detalle-familiar/{id}', [UserController::class, 'familiarShow'])->name('familiar.detalle_familiar');
Route::get('/editar-familiar/{id?}', [UserController::class, 'familiarEdit'])->name('familiar.editar_familiar');
Route::put('/editar-familiar/{id}', [UserController::class, 'familiarUpdate'])->name('familiar.update');



use App\Http\Controllers\Api\Incidencias\IncidentController;

Route::get('/incidencias',function(){
    return view('incidencias.index');
})->name('incidencias.index');

Route::patch('/incidencias/{id}/estado', [IncidentController::class, 'updateStatus'])->name('incidencias.update-status');

Route::get('/alertas',function(){
    return view('alertas.index');
})->name('alertas.index');


Route::get('/dashboard', [ResidentController::class, 'count'])->name('dashboard');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
