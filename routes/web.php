<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\InformacionController;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\ReporteActividadController;
use App\Http\Controllers\ReporteController;
use App\Http\Controllers\UserController;
use App\Models\Convenio;
use Carbon\Carbon;
use Illuminate\Routing\Router;
use App\Http\Controllers\AjusteHoraController;
use App\Http\Controllers\AsistenciaJsonController;

//Route::get('/', function () { return view('index'); })->middleware('auth');
Route::get('/', [App\Http\Controllers\AdminController::class, 'index'])->middleware('auth')->name('index');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Auth::routes(['register'=>false]);


Route::get('/refresh-csrf', function() {
    return response()->json(['token' => csrf_token()]);
})->middleware('web'); // Asegúrate de usar el middleware web

/* Route::get('/check-session', function() {
    return response()->json(['status' => 'active']);
})->middleware('web'); */

// Verificación de sesión
Route::get('/session/status', function() {
    return response()->json([
        'valid' => Auth::check(),
        'last_activity' => session()->get('last_activity'),
        'remaining' => Auth::check() ? (config('session.lifetime') * 60 - now()->diffInMinutes(Carbon::parse(session('last_activity')))) : 0
    ]);
});

// Extensión de sesión
Route::post('/session/extend', function() {
    session()->put('last_activity', now());
    return response()->json(['success' => true]);
})->middleware('auth');

/* Route::get('/', function () {
    return view('welcome');
}); */

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Ruta para reportes de Informaciones*/
//Route::get('/informaciones/reportes', [InformacionController::class, 'reportes'])->name('informaciones.reportes');
//Route::get('/informaciones/reportes', [App\Http\Controllers\InformacionController::class, 'reportes'])->name('informaciones.reportes');
Route::get('/informaciones/pdf', [App\Http\Controllers\InformacionController::class, 'pdf'])->name('informaciones.pdf');
/* Reporte de Inscripcion */
Route::get('/inscripciones/pdf', [App\Http\Controllers\InscripcionController::class, 'pdf'])->name('inscripciones.pdf');
Route::get('/inscripciones/pdf_fechas', [App\Http\Controllers\InscripcionController::class, 'pdf_fechas'])/* ->name('inscripciones.pdf') */;
/* Reporte de Asistencia */
Route::get('/asistencias/pdf', [App\Http\Controllers\AsistenciaController::class, 'pdf'])->name('asistencias.pdf');

/* Route::get('/informaciones', [App\Http\Controllers\InformacionController::class, 'store'])->name('informaciones.store'); */

Route::resource('/informaciones', \App\Http\Controllers\InformacionController::class)->middleware('can:informaciones');

Route::resource('/inscripciones', \App\Http\Controllers\InscripcionController::class)->middleware('can:inscripciones');

Route::resource('/reportes', \App\Http\Controllers\ReporteController::class);
Route::get('/reportes/{reporte}', [\App\Http\Controllers\ReporteController::class, 'show'])->name('reportes.show');

/* Route::get('/usuarios/{usuario}/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('usuarios.edit');
Route::get('/usuarios/create/{id?}', [\App\Http\Controllers\UserController::class, 'create'])->name('usuarios.create');
Route::resource('/usuarios', \App\Http\Controllers\UserController::class)->except(['create', 'edit'])->middleware('can:usuarios');  */

// Estas rutas no necesitan autorización (por ejemplo, cambio de contraseña personal)
Route::patch('/usuarios/{usuario}', [UserController::class, 'update'])->name('usuarios.update');
Route::get('/usuarios/{usuario}/edit', [UserController::class, 'edit'])->name('usuarios.edit');
Route::get('/usuarios/create/{id?}', [UserController::class, 'create'])->name('usuarios.create');
// Estas sí requieren permiso (administración de usuarios)
Route::resource('/usuarios', UserController::class)->except(['create', 'edit', 'update'])->middleware('can:usuarios');


Route::resource('/roles', \App\Http\Controllers\RoleController::class)->middleware('can:roles');

Route::resource('/permisos', \App\Http\Controllers\PermisoController::class)->middleware('can:permisos');

Route::resource('/areas', \App\Http\Controllers\AreaController::class)->middleware('can:areas');

Route::resource('/generaciones', \App\Http\Controllers\GeneracionController::class)->middleware('can:generaciones');

Route::resource('/tarjetas', \App\Http\Controllers\TarjetaController::class)->middleware('can:tarjetas');

Route::resource('/requisitos', \App\Http\Controllers\RequisitoController::class)->middleware('can:requisitos');

Route::resource('/extensiones', \App\Http\Controllers\ExtensionController::class)->middleware('can:generaciones');

Route::resource('/asignartarjetas', \App\Http\Controllers\AsignarTarjetaController::class)->middleware('can:asignartarjetas');

Route::get('/rfid', [\App\Http\Controllers\TarjetaController::class, 'store'])->name('rfid');

Route::get('/asistencia', [\App\Http\Controllers\AsistenciaController::class, 'createasistencia'])->name('asistencia');

/* Route::get('/actualizar', [\App\Http\Controllers\AsistenciaController::class, 'update']); */

Route::get('/asistencias/{asistencia}', [\App\Http\Controllers\AsistenciaController::class, 'show'])->name('asistencias.show')/* ->middleware('can:asistencia.show') */;

Route::resource('/asistencias', \App\Http\Controllers\AsistenciaController::class)->except(['show'])->middleware('can:asistencias');

Route::put('asistencias/updateFields/{id}', [AsistenciaController::class, 'updateFields'])->name('asistencias.updateFields');
Route::get('asistencias/crear/{id}', [AsistenciaController::class, 'crearFields'])->name('asistencias.crearFields');
Route::post('asistencias/storeFields', [AsistenciaController::class, 'storeFields'])->name('asistencias.storeFields');
/* este es la rutas de reportes actividades */
Route::get('/reporteactividad', [ReporteActividadController::class, 'reporteactividad'])->name('asistencias.reporteactividad')->middleware('can:reporteactividad');
Route::post('/guardar-actividad', [ReporteActividadController::class, 'guardarActividad'])->name('guardarActividad');
// Mostrar el formulario de edición
Route::get('/editar-actividad/{id}', [ReporteActividadController::class, 'editarActividad'])->name('editarActividad');
//Route::get('/reporteactividad/details/{id}', [ReporteActividadController::class, 'details'])->name('reporteactividad.details');

// Guardar los cambios en la base de datos
Route::put('/reporteactividad/{id}', [ReporteActividadController::class, 'actualizarActividad'])->name('reporteactividad.actualizar');
// Eliminar una actividad
Route::delete('/eliminar-actividad/{id}', [ReporteActividadController::class, 'eliminarActividad'])->name('eliminarActividad');

/* Route::resource('/reporteactividades', \App\Http\Controllers\ReporteActividadController::class); */
/* Route::get('/reporteactividad/{id}/usuario', [ReporteActividadController::class, 'mostrarUsuarioDeReporte'])->name('reporteactividad.mostrarUsuario'); */


/* Route::get('/asistencias/{id}', [AsistenciaController::class, 'show'])->name('asistencias.show'); */


Route::resource('/multas', \App\Http\Controllers\MultaController::class)->middleware('can:multas');

Route::resource('/actividads', \App\Http\Controllers\ActividadController::class)->middleware('can:actividads');

Route::resource('/programas', \App\Http\Controllers\ProgramaController::class)->middleware('can:programas');

Route::resource('/detalles', \App\Http\Controllers\DetalleController::class)->middleware('can:detalles');

Route::resource('/certificados', \App\Http\Controllers\CertificadoController::class)->middleware('can:certificados');

/* Route::resource('/cron_schedule', \App\Http\Controllers\CronScheduleController::class); */
Route::get('/cron-schedule/edit', [\App\Http\Controllers\CronScheduleController::class, 'edit'])->name('cron_schedule.edit')->middleware('can:configuraciones');
Route::put('/cron-schedule/update', [\App\Http\Controllers\CronScheduleController::class, 'update'])->name('cron_schedule.update');

Route::get('certificadopdf/{id}', [App\Http\Controllers\GenerarCertificadoController::class, 'generarcertificado'])->name('certificadopdf');
Route::get('certificadoword/{id}', [App\Http\Controllers\GenerarCertificadoWordController::class, 'generarCertificadoHTML'])->name('certificadoword');

/* Route::get('/test-websocket', function() {
    event(new App\Events\TestEvent('¡Funciona!'));
    return "Evento enviado";
}); */

// ====== RUTAS CORREGIDAS PARA AJUSTE DE HORAS ======
Route::get('/ajuste-horas/{id}/obtener', [AjusteHoraController::class, 'obtener'])->name('ajuste-horas.obtener');

// Se añaden los métodos ->name(...) para que coincidan con tu vista Blade:
Route::post('/ajuste-horas/{id}/guardar-extra', [AsistenciaJsonController::class, 'guardar'])->name('ajuste-horas.guardar-extra');
Route::post('/ajuste-horas/{id}/guardar-descuento', [AsistenciaJsonController::class, 'guardar'])->name('ajuste-horas.guardar-descuento');

    
Route::resource('/empresas',\App\Http\Controllers\EmpresaController::class);

Route::resource('/sucursal',\App\Http\Controllers\SucursalController::class);

Route::resource('/tipo_sedes',\App\Http\Controllers\Tipo_sedesController::class);