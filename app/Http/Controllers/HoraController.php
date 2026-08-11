<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Asistencia;
use Illuminate\Support\Facades\Auth;

class HoraController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Obtener todas las asistencias del usuario
        $asistencias = Asistencia::where('user_id', $user->id)->get();

        // Calcular horas laborales: 1 asistencia = 4 horas
        $totalHorasLaborales = $asistencias->count() * 4;
        $detalleHorasLaborales = "Total de asistencias: {$asistencias->count()} × 4h = {$totalHorasLaborales}h";

        // Horas académicas: por ejemplo puedes usar un campo horas_academicas en la tabla Asistencia
        $totalHorasAcademicas = $asistencias->sum('horas_academicas');
        $detalleHorasAcademicas = "Total horas académicas sumadas: {$totalHorasAcademicas}h";

        return view('asistencias.index', compact(
            'asistencias',
            'totalHorasLaborales',
            'detalleHorasLaborales',
            'totalHorasAcademicas',
            'detalleHorasAcademicas'
        ));
    }
}
