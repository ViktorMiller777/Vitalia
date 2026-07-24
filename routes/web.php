<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard',function(){
    return view('dashboard');
})->name('dashboard');

Route::get('/internos', function () {
    return view('internos.index');
})->name('internos.index');

Route::get('/agregar-internos', function () {
    return view('internos.agregar_interno'); 
})->name('internos.create');

Route::get('/agregar-cuidador',function(){
    return view('cuidadores.agregar_cuidador');
})->name('cuidadores.create');

Route::get('/cuidadores',function(){
    return view('cuidadores.index');
})->name('cuidadores.index');

Route::get('/familiares',function(){
    return view('familiar.index');
})->name('familiares.index');

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
