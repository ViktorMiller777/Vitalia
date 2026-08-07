<?php

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
Route::get('/internos', function () {
    return view('internos.index');
})->name('internos.index');

Route::get('/agregar-internos', function () {
    return view('internos.agregar_interno'); 
})->name('internos.create');

Route::get('/detalle-interno',function(){ //NOTA ESTA RUTA TENDRA EL PARAMETRO EL ID DEL INTERNO PARA MOSTRAR SUS DATOS
    return view('internos.detalle_interno');
})->name('internos.detalle_interno');

Route::get('/editar-interno',function(){ //NOTA, ESTA RUTA TENDRA DE PARAMETRO EL ID DEL INTERNO PARA MOSTRAR Y EDITAR SUS DATOS
    return view('internos.editar_interno');
})->name('internos.editar_interno');

//VISTAS DE CUIDADORES(ADMIN)
Route::get('/cuidadores',function(){
    return view('cuidadores.index');
})->name('cuidadores.index');

Route::get('/agregar-cuidador',function(){
    return view('cuidadores.agregar_cuidador');
})->name('cuidadores.create');

Route::get('/detalle-cuidador',function(){  //NOTA, ESTA RUTA TENDRA DE PARAMETRO EL ID DEL CUIDADOR PARA MOSTRAR SUS DATOS
    return view('cuidadores.detalle_cuidador');
})->name('cuidadores.detalle_cuidador');

Route::get('/editar-cuidador',function (){
    return view('cuidadores.editar_cuidador');
})->name('cuidadores.editar_cuidador');

//VISTAS DE FAMILIARES(ADMIN)

Route::get('/familiares',function(){
    return view('familiar.index');
})->name('familiares.index');

Route::get('/agregar-familiar',function(){
    return view('familiar.agregar_familiar');
})->name('familiar.create');

Route::get('/detalle-familiar',function(){
    return view('familiar.detalle_familiar');
})->name('familiar.detalle_familiar');

Route::get('/editar-familiar',function(){
    return view('familiar.editar_familiar');
})->name('familiar.editar_familiar');



Route::get('/incidencias',function(){
    return view('incidencias.index');
})->name('incidencias.index');

Route::get('/alertas',function(){
    return view('alertas.index');
})->name('alertas.index');







// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
