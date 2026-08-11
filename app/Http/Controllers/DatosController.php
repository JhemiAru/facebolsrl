<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\ActualizacionEnTiempoReal;
use Illuminate\Support\Facades\DB;

class DatosController extends Controller
{
    public function actualizarDatos()
{
    // Lógica para obtener datos de la DB
    $datos = DB::table('asistencias.show')->latest()->first();
    $datos = DB::table('asignartarjetas.create')->latest()->first();
    
    // Disparar evento
    event(new ActualizacionEnTiempoReal($datos));
    
    return response()->json(['success' => true]);
}
}
