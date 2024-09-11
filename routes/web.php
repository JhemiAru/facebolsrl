<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InformacionController;

//Route::get('/', function () { return view('index'); })->middleware('auth');
Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->middleware('auth')->name('index');

Auth::routes(['register'=>true]);


//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Ruta para reportes */
Route::get('/informaciones/reportes', [InformacionController::class, 'reportes'])->name('informaciones.reportes');
//Route::get('/informaciones/reportes', [App\Http\Controllers\InformacionController::class, 'reportes'])->name('informaciones.reportes');
Route::get('/informaciones/pdf', [App\Http\Controllers\InformacionController::class, 'pdf'])->name('informaciones.pdf');


/* Route::get('/informaciones', [App\Http\Controllers\InformacionController::class, 'store'])->name('informaciones.store'); */

Route::resource('/informaciones', \App\Http\Controllers\InformacionController::class);

Route::resource('/inscripciones', \App\Http\Controllers\InscripcionController::class);

Route::resource('/usuarios', \App\Http\Controllers\UserController::class)/* ->middleware('can:usuarios') */;

Route::resource('/roles', \App\Http\Controllers\RoleController::class);

Route::resource('/permisos', \App\Http\Controllers\PermisoController::class);

Route::resource('/areas', \App\Http\Controllers\AreaController::class);

Route::resource('/generaciones', \App\Http\Controllers\GeneracionController::class);

Route::resource('/tarjetas', \App\Http\Controllers\TarjetaController::class);

Route::resource('/requisitos', \App\Http\Controllers\RequisitoController::class);

Route::resource('/extensiones', \App\Http\Controllers\ExtensionController::class);

Route::resource('/asignartarjetas', \App\Http\Controllers\AsignarTarjetaController::class);

Route::get('/rfid', [\App\Http\Controllers\TarjetaController::class, 'store'])->name('rfid');

Route::get('/asistencia', [\App\Http\Controllers\AsistenciaController::class, 'createasistencia'])->name('asistencia');

/* Route::get('/actualizar', [\App\Http\Controllers\AsistenciaController::class, 'update']); */

Route::resource('/asistencias', \App\Http\Controllers\AsistenciaController::class);

Route::resource('/multas', \App\Http\Controllers\MultaController::class);

Route::resource('/actividads', \App\Http\Controllers\ActividadController::class);

Route::resource('/programas', \App\Http\Controllers\ProgramaController::class);

Route::resource('/detalles', \App\Http\Controllers\DetalleController::class);

Route::resource('/certificados', \App\Http\Controllers\CertificadoController::class);

Route::get('certificadopdf/{id}', [App\Http\Controllers\GenerarCertificadoController::class, 'generarcertificado'])->name('certificadopdf');
